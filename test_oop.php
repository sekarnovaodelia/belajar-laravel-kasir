<?php

class Kendaraan {
    public $nama;
    
    public function __construct($nama) {
        $this->nama = $nama;
    }
    
    public function klakson() {
        return "Beep!";
    }
}

// Mobil mewarisi semuaViewController Kendaraan
class Mobil extends Kendaraan {
    public function pintu() {
        return "4 pintu";
    }
    
    // Override method induk
    public function klakson() {
        return "Tiin! Tiin!";
    }
}

$avanza = new Mobil("Avanza");
echo $avanza->nama . "\n";      // Avanza (warisan)
echo $avanza->klakson() . "\n"; // Tiin! Tiin! (override)
echo $avanza->pintu() . "\n";   // 4 pintu (method sendiri)