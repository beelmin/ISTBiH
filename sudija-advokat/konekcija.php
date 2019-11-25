<?php


class Konekcija
{
	private $imeBaze='zatvor'; 
	private $korisnik='root';
	private $lozinka='';
	private $host='localhost';
	private $konekcija='';
	
  
	public function Konekcija($h, $k, $iB, $l="")
	{
		$this->host=$h; 
	    $this->korisnik=$k;
		$this->imeBaze=$iB;
		$this->lozinka=$l;
	}
	
	public function konektujSe()
	{
		$r=new mysqli($this->host, $this->korisnik, $this->lozinka, $this->imeBaze);
		if($r->connect_error) die($r->connect_error);
		else $this->konekcija=$r;
		
		return $this->konekcija;
	}
	
	public function izvrsiMySQLUpit($upit){
		$rez=$this->konekcija->query($upit);
		if(!$rez) die($this->konekcija->error);
		return $rez;
	}

}

?>