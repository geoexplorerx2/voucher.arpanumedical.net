<?php

namespace App\Http\Controllers;

use App\Models\UetdsZone;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use SoapClient;

class UetdsController extends Controller
{

    public $SOAP_URL = "https://servis.turkiye.gov.tr/services/g2g/kdgm/uetdsarizi?wsdl";
    public $USERNAME = "872431";
    public $PASSWORD = "I044B8IQJH";

    public function __construct()
    {

        $this->middleware('auth');


    }

    public function seferEkle($aracPlaka, $hareketTarihi, $hareketSaati, $seferAciklama, $firmaSeferNo, $seferBitisTarihi, $seferBitisSaati)
    {
        try {
            $soap_client = new SoapClient($this->SOAP_URL);

            $params = array(
                'wsuser' => [
                    'kullaniciAdi' => $this->USERNAME,
                    'sifre' => $this->PASSWORD
                ],
                'ariziSeferBilgileriInput' => [
                    "aracPlaka" => $aracPlaka,
                    "seferAciklama" => $seferAciklama,
                    "hareketTarihi" => $hareketTarihi,
                    "hareketSaati" => $hareketSaati,
                    "firmaSeferNo" => $firmaSeferNo,
                    "seferBitisTarihi" => $seferBitisTarihi,
                    "seferBitisSaati" => $seferBitisSaati]
            );

            $options = array(
                'login' => $this->USERNAME,
                'password' => $this->PASSWORD,
            );


            $soap_client = new SoapClient($this->SOAP_URL, $options);
            $soap_return = $soap_client->__soapCall("seferEkle", array($params));


            $result = $soap_return->return->uetdsSeferReferansNo;
            $uetdsSeferReferansNo = $result;
            return $uetdsSeferReferansNo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }



    public function seferIptal($uetdsSeferReferansNo)
    {

        try {

            $soap_client = new SoapClient($this->SOAP_URL);

            $params = array(
                'wsuser' => [
                    'kullaniciAdi' => $this->USERNAME,
                    'sifre' => $this->PASSWORD
                ],
                'uetdsSeferReferansNo' => $uetdsSeferReferansNo,
                 'iptalAciklama' => 'Yolcu Kaynaklı Sefer İptal Edilmiştir.'
            );


            $options = array(
                'login' => $this->USERNAME,
                'password' => $this->PASSWORD,
            );

            $soap_client = new SoapClient($this->SOAP_URL, $options);
            $soap_return = $soap_client->__soapCall("seferIptal", array($params));

            return $soap_return->return->sonucMesaji;
        } catch (\SoapFault $e) {
            echo $e->getMessage();
        }

    }

    public function seferPlakaDegistir($uetdsSeferReferansNo, $tasitPlakaNo)
    {


    }

    public function personelEkle($uetdsSeferReferansNo, $turKodu, $uyrukUlke, $tcKimlikPasaportno, $cinsiyet, $adi, $soyadi, $telefon)
    {
        try {
            $soap_client = new SoapClient($this->SOAP_URL);

            $params = array(
                'wsuser' => [
                    'kullaniciAdi' => $this->USERNAME,
                    'sifre' => $this->PASSWORD
                ],
                'uetdsSeferReferansNo' => $uetdsSeferReferansNo,
                'seferPersonelBilgileriInput' => [
                    "turKodu" => $turKodu,
                    "uyrukUlke" => $uyrukUlke,
                    "tcKimlikPasaportNo" => $tcKimlikPasaportno,
                    "cinsiyet" => $cinsiyet,
                    "adi" => $adi,
                    "soyadi" => $soyadi,
                    "telefon" => $telefon]
            );


            $options = array(
                'login' => $this->USERNAME,
                'password' => $this->PASSWORD,
            );

            $soap_client = new SoapClient($this->SOAP_URL, $options);
            $soap_return = $soap_client->__soapCall("personelEkle", array($params));

            $sonucKodu = $soap_return->return->sonucKodu;
            return $sonucKodu;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function personelIptal($personelTCKimlikPasaportNo, $iptalAciklama, $uetdsSeferReferansNo)
    {

    }

    public function yolcuEkle($uetdsSeferReferansNo, $grupId, $uyrukUlke, $tcKimlikPasaportNo, $adi, $soyadi, $cinsiyet)
    {
        try {
            $soap_client = new SoapClient($this->SOAP_URL);

            $params = array(
                'wsuser' => [
                    'kullaniciAdi' => $this->USERNAME,
                    'sifre' => $this->PASSWORD
                ],
                'uetdsSeferReferansNo' => $uetdsSeferReferansNo,
                'seferYolcuBilgileriInput' => [
                    "uyrukUlke" => $uyrukUlke,
                    "tcKimlikPasaportNo" => $tcKimlikPasaportNo,
                    "adi" => $adi,
                    "soyadi" => $soyadi,
                    "cinsiyet" => $cinsiyet,
                    "koltukNo" => '',
                    "grupId" => $grupId]
            );


            $options = array(
                'login' => $this->USERNAME,
                'password' => $this->PASSWORD,
            );

            $soap_client = new SoapClient($this->SOAP_URL, $options);
            $soap_return = $soap_client->__soapCall("yolcuEkle", array($params));


            $uetdsYolcuRefNo = $soap_return->return->uetdsYolcuRefNo;
            return $uetdsYolcuRefNo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function seferGrupEkle($uetdsSeferReferansNo, $grupAdi, $grupAciklama, $baslangicUlke, $baslangicIl, $baslangicIlce, $baslangicYer, $bitisUlke, $bitisIl, $bitisIlce, $bitisYer, $grupUcret)
    {
        try {
            $soap_client = new SoapClient($this->SOAP_URL);

            $params = array(
                'wsuser' => [
                    'kullaniciAdi' => $this->USERNAME,
                    'sifre' => $this->PASSWORD
                ],
                'uetdsSeferReferansNo' => $uetdsSeferReferansNo,
                'seferGrupBilgileriInput' => [
                    "grupAciklama" => $grupAciklama,
                    "baslangicUlke" => $baslangicUlke,
                    "baslangicIl" => $baslangicIl,
                    "baslangicIlce" => $baslangicIlce,
                    "baslangicYer" => $baslangicYer,
                    "bitisUlke" => $bitisUlke,
                    "bitisIl" => $bitisIl,
                    "bitisIlce" => $bitisIlce,
                    "bitisYer" => $bitisYer,
                    "grupAdi" => $grupAdi,
                    "grupUcret" => $grupUcret]
            );


            $options = array(
                'login' => $this->USERNAME,
                'password' => $this->PASSWORD,
            );

            $soap_client = new SoapClient($this->SOAP_URL, $options);
            $soap_return = $soap_client->__soapCall("seferGrupEkle", array($params));

            $uetdsGrupRefNo = $soap_return->return->uetdsGrupRefNo;
            return $uetdsGrupRefNo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function yolcuIptalUetdsYolcuRefNoIle($uetdsSeferReferansNo, $uetdsYolcuReferansNo, $iptalAciklama)
    {


    }

    public function seferDetayCiktisiAl($uetdsSeferReferansNo)
    {

        try {

            $soap_client = new SoapClient($this->SOAP_URL);

            $params = array(
                'wsuser' => [
                    'kullaniciAdi' => $this->USERNAME,
                    'sifre' => $this->PASSWORD
                ],
                'uetdsSeferReferansNo' => $uetdsSeferReferansNo
            );


            $options = array(
                'login' => $this->USERNAME,
                'password' => $this->PASSWORD,
            );

            $soap_client = new SoapClient($this->SOAP_URL, $options);
            $soap_return = $soap_client->__soapCall("seferDetayCiktisiAl", array($params));

            return $soap_return->return->sonucPdf;
        } catch (\SoapFault $e) {
            echo $e->getMessage();
        }

    }


    public function getUetdsCities()
    {
        $uetdsCities = UetdsZone::select('city_code', 'city_name')->distinct()->get();

        $output = [];
        foreach ($uetdsCities as $city) {
            $output[$city->city_code] = $city->city_name;
        }

        return json_encode($output);
    }

    public function getUetdsZones($id)
    {
        $uetdsZones = UetdsZone::select('zone_code', 'zone')->where('city_code', '=', $id)->distinct()->get();

        $output = [];
        foreach ($uetdsZones as $zone) {
            $output[$zone->zone_code] = $zone->zone;
        }

        return json_encode($output);
    }


}
