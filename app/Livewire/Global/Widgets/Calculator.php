<?php

namespace App\Livewire\Global\Widgets;

use App\Mail\KalkulationEingang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class Calculator extends Component
{
    public $showCalculator = false;
    public $step = 1;

    public $selectedServices = [];
    public $serviceDetailsVisible = [];

    public $form = [
        'vorname' => '',
        'nachname' => '',
        'email' => '',
        'telefon' => '',
        // dynamische Felder folgen
    ];

    public $gesamtKosten = 0;
    public $serviceCosts = [];
    public $serviceSummaries = [];

    public $leistungen = [
        [
            'name' => 'Treppenhausreinigung',
            'felder' => [
                'treppenhaus_etagen' => [
                    'label' => 'Anzahl Etagen',
                    'min' => 0,
                    'max' => 40,
                    'info' => 'Geben Sie die Gesamtzahl der Etagen im Treppenhaus an, die gereinigt werden sollen.'
                ],
                'treppenhaus_freq' => [
                    'label' => 'Häufigkeit(Monat)',
                    'min' => 0,
                    'max' => 12,
                    'info' => 'Wie oft pro Monat soll das Treppenhaus gereinigt werden?'
                ]
            ]
        ],
        [
            'name' => 'Kellerreinigung',
            'felder' => [
                'keller_groesse' => [
                    'label' => 'Kellergröße',
                    'min' => 0,
                    'max' => 200,
                    'info' => 'Geben Sie die Fläche des Kellers in Quadratmetern an, die gereinigt werden soll.'
                ],
                'keller_freq' => [
                    'label' => 'Häufigkeit(Monat)',
                    'min' => 0,
                    'max' => 12,
                    'info' => 'Wie oft pro Monat soll der Keller gereinigt werden?'
                ]
            ]
        ],
        [
            'name' => 'Heckenschnitt',
            'felder' => [
                'hecke_lfm' => [
                    'label' => 'Heckenlänge',
                    'min' => 0,
                    'max' => 200,
                    'info' => 'Gesamtlänge der Hecke in laufenden Metern, die geschnitten werden soll.'
                ],
                'hecke_freq' => [
                    'label' => 'Häufigkeit(Jahr)',
                    'min' => 0,
                    'max' => 12,
                    'info' => 'Wie oft pro Jahr soll die Hecke geschnitten werden?'
                ]
            ]
        ],
        [
            'name' => 'Hof- und Gehwegspflege',
            'felder' => [
                'hof_groesse' => [
                    'label' => 'Fläche',
                    'min' => 0,
                    'max' => 500,
                    'info' => 'Gesamte zu pflegende Fläche in Quadratmetern, z. B. Hof, Wege oder Parkplätze.'
                ],
                'hof_freq' => [
                    'label' => 'Häufigkeit(Monat)',
                    'min' => 0,
                    'max' => 12,
                    'info' => 'Wie oft pro Monat soll die Pflege durchgeführt werden?'
                ]
            ]
        ],
        [
            'name' => 'Dachrinnenreinigung',
            'felder' => [
                'dachrinne_lfm' => [
                    'label' => 'Dachrinne lfm',
                    'min' => 0,
                    'max' => 100,
                    'info' => 'Gesamtlänge der zu reinigenden Dachrinnen in laufenden Metern.'
                ],
                'dachrinne_freq' => [
                    'label' => 'Häufigkeit(Jahr)',
                    'min' => 0,
                    'max' => 12,
                    'info' => 'Wie oft pro Jahr soll die Dachrinne gereinigt werden?'
                ]
            ]
        ],
        [
            'name' => 'Fensterreinigung',
            'felder' => [
                'fenster_anzahl' => [
                    'label' => 'Fensteranzahl',
                    'min' => 0,
                    'max' => 100,
                    'info' => 'Wie viele Fenster sollen gereinigt werden? Bitte Gesamtanzahl angeben.'
                ],
                'fenster_freq' => [
                    'label' => 'Häufigkeit(Jahr)',
                    'min' => 0,
                    'max' => 12,
                    'info' => 'Wie oft pro Jahr sollen die Fenster gereinigt werden?'
                ]
            ]
        ],
        [
            'name' => 'Winterdienst',
            'felder' => [
                'winterdienst_flaeche' => [
                    'label' => 'Winterdienst Fläche',
                    'min' => 0,
                    'max' => 300,
                    'info' => 'Gesamte Fläche in Quadratmetern, auf der im Winter Schnee geräumt oder gestreut werden soll.'
                ]
            ]
        ]
    ];


    public $preise = [
        'Treppenhausreinigung'=>['formel_text'=>'Etagen×Häufigkeit×12 €','formel_method'=>'calculateTreppenhausreinigung'],
        'Kellerreinigung'=>['formel_text'=>'m²×Häufigkeit×2 €','formel_method'=>'calculateKellerreinigung'],
        'Heckenschnitt'=>['formel_text'=>'lfm×Häufigkeit×5 €','formel_method'=>'calculateHeckenschnitt'],
        'Hof- und Gehwegspflege'=>['formel_text'=>'m²×Häufigkeit×2 €','formel_method'=>'calculateHofpflege'],
        'Dachrinnenreinigung'=>['formel_text'=>'lfm×Häufigkeit×5 €','formel_method'=>'calculateDachrinnenreinigung'],
        'Fensterreinigung'=>['formel_text'=>'Anzahl×Häufigkeit×7,50 €','formel_method'=>'calculateFensterreinigung'],
        'Winterdienst'=>['formel_text'=>'m²×2 €','formel_method'=>'calculateWinterdienst'],
    ];

    public function render()
    {
        $this->recalculateCosts();
        return view('livewire.widgets.calculator');
    }

    public function startCalculator()
    {
        $this->showCalculator = true;
        $this->step = 1;
    }

    public function toggleService($svc)
    {
        if (in_array($svc,$this->selectedServices)) {
            $this->selectedServices = array_filter($this->selectedServices, fn($s)=>$s!==$svc);
            unset($this->serviceDetailsVisible[$svc]);
        } else {
            $this->selectedServices[] = $svc;
            $this->serviceDetailsVisible[$svc]=true;
            foreach ($this->leistungen as $l) {
                if ($l['name']===$svc) {
                    foreach ($l['felder'] as $k=>$_) {
                        $this->form[$k]=0;
                    }
                }
            }
        }
        $this->recalculateCosts();
    }

    public function recalculateCosts()
    {
        $this->gesamtKosten=0;
        $this->serviceCosts=[];
        $this->serviceSummaries=[];
        foreach($this->selectedServices as $svc){
            if(isset($this->preise[$svc])){
                $m=$this->preise[$svc]['formel_method'];
                $cost=$this->$m($this->form);
                $this->serviceCosts[$svc]= $cost;
                $this->gesamtKosten += $cost;
            }
            $this->serviceSummaries[$svc]= $this->generateSummaryForService($svc);
        }
    }

    public function calculateTreppenhausreinigung($f){
        return ($f['treppenhaus_etagen']??0)*($f['treppenhaus_freq']??0)*12;
    }

    public function calculateKellerreinigung($f){
        return ($f['keller_groesse']??0)*($f['keller_freq']??0)*2.0;
    }

    public function calculateHeckenschnitt($f){
        return (($f['hecke_lfm'] ?? 0) * ($f['hecke_freq'] ?? 0) * 5.0) / 12;
    }

    public function calculateHofpflege($f){
        return (($f['hof_groesse'] ?? 0) * ($f['hof_freq'] ?? 0) * 2.0) / 12;
    }

    public function calculateDachrinnenreinigung($f){
        return (($f['dachrinne_lfm'] ?? 0) * ($f['dachrinne_freq'] ?? 0) * 5.0) / 12;
    }

    public function calculateFensterreinigung($f){
        return (($f['fenster_anzahl'] ?? 0) * ($f['fenster_freq'] ?? 0) * 7.5) / 12;
    }
    public function calculateWinterdienst($f)
    {
        return ($f['winterdienst_flaeche']??0)*2.0;
    }

    public function generateSummaryForService($svc){
        $sum = '';
        foreach($this->leistungen as $l){
            if($l['name'] === $svc){
                foreach($l['felder'] as $k => $feld){
                    $v = $this->form[$k] ?? '–';
                    $einheit = $feld['einheit'] ?? '';
                    $sum .= "<div><strong>{$feld['label']}:</strong> {$v} " . ($einheit ? $einheit : '') . "</div>";
                }
            }
        }
        return $sum;
    }

    public function goNext(){ if($this->step<3) $this->step++; }
    public function goBack(){ if($this->step>1) $this->step--; }

    public function submit()
    {
        // ⚠️ Validation
        $this->validate([
            'form.vorname' => 'required|string|max:100',
            'form.nachname' => 'required|string|max:100',
            'form.email' => 'required|email',
            'form.telefon' => 'nullable|string|max:50',
        ]);

        $data = [
            'vorname' => $this->form['vorname'],
            'nachname' => $this->form['nachname'],
            'email' => $this->form['email'],
            'telefon' => $this->form['telefon'],
            'gesamt' => number_format($this->gesamtKosten, 2, ',', '.'),
            'services' => []
        ];

        foreach ($this->selectedServices as $svc) {
            $data['services'][] = [
                'name' => $svc,
                'summary' => strip_tags($this->serviceSummaries[$svc] ?? ''),
                'formel' => $this->preise[$svc]['formel_text'] ?? '',
                'cost' => number_format($this->serviceCosts[$svc] ?? 0, 2, ',', '.')
            ];
        }

        // PDF generieren
        $pdf = Pdf::loadView('global.mails.calculation_pdf', ['data' => $data]);

        // Temporäre Datei erstellen
        $filename = 'Anfrage_' . Str::slug($this->form['nachname']) . '_' . now()->timestamp . '.pdf';
        $pdfPath = storage_path('app/public/tmp/' . $filename);
        file_put_contents($pdfPath, $pdf->output());

        // Mail an Kunden senden
        Mail::to($this->form['email'])->send(new \App\Mail\KalkulationKunde($data, $pdfPath));

        // Mail an eigenes Postfach
        Mail::to(env('MAIL_FROM_ADDRESS', 'kontakt@alina-steinhauer.de'))->send(new \App\Mail\KalkulationEingang($data, $pdfPath));

        // Aufräumen
        unlink($pdfPath);

        // Erfolgsmeldung
        session()->flash('success', 'Die Kalkulation wurde erfolgreich an Ihre E-Mail-Adresse gesendet.');
    }
}

// PDF als Download zurückgeben
/*return response()->streamDownload(function () use ($pdf) {
    echo $pdf->output();
}, 'Anfragebestätigung.pdf');*/
