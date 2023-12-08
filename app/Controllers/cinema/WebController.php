<?php

namespace App\Controllers\cinema;
use App\Controllers\BaseController;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\Exceptions\RedirectException;
use Error;
use Exception;
use Predis\Connection\Cluster\RedisCluster;

class WebController extends BaseController
{
    protected $cinemaModel;
    protected $locationModel;
    protected $session;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->cinemaModel = model('CinemaModel');
        $this->locationModel = model('LocationModel');
    }

    public function index()
    {
        $whereFetch = "cinema.status = 1";
        $cinemas = $this->cinemaModel
        ->select("
        cinema.id,
        cinema.name,
        location.description AS location_description, 
        location.lat AS location_lat, 
        location.longi AS location_longi") 
        ->join('location', 'location.id = cinema.location_id')
        ->where($whereFetch)->orderBy('location.id', 'asc')->findAll();
        return view('cinemas/index', compact('cinemas'));
    }


    public function show($id = null) {
        $whereFetch = "cinema.status = 1";
        $cinema = $this->cinemaModel
        ->select("
        cinema.id,
        cinema.name,
        location.description AS location_description, 
        location.lat AS location_lat, 
        location.longi AS location_longi") 
        ->join('location', 'cinema.location_id = location.id') 
        ->where($whereFetch)->find((int)$id);

        if($cinema) {
            return view('cinemas/show', compact('cinema'));
        } else {
            return redirect()->to(site_url('/cinemas'));
        }
    }

    public function new() {
        return view('cinemas/new');
    }

    public function create() {
        
        $this->locationModel->save([
            "description" => $this->request->getVar('locationDescription'),
            "longi" => $this->request->getVar('locationLongi'),
            "lat" => $this->request->getVar('locationLat'),
        ]);

        $locationId = $this->db->insertID();

        $this->cinemaModel->save([
            "name" =>$this->request->getVar('name'),
            "location_id" =>$locationId,
        ]);


        session()->setFlashdata("success", "Se agregó un nuevo cine");
        return redirect()->to(site_url('/cinemas'));
    }

    public function edit($id = null) {
        $whereFetch = "cinema.status = 1";
        $cinema = $this->cinemaModel
        ->select("cinema.id, cinema.name, location.description AS location_description, location.lat AS location_lat, location.longi AS location_longi") 
        ->join('location', 'location.id = cinema.location_id')
        ->where($whereFetch)->find((int)$id);

        if($cinema) {
            return view('cinemas/edit', compact("cinema"));
        } else {
            session()->setFlashdata('failed', 'Cine no encontrado');
            return redirect()->to('/cinemas');
        }
    }


    public function update($id) {
        
        $cinema = $this->cinemaModel->where("status = 1")->find($id);

        if(!$cinema) {
            // enviar mensaje a session
            return;
        }

        $this->locationModel->save([
            "description" => $this->request->getVar('locationDescription'),
            "longi" => $this->request->getVar('locationLongi'),
            "lat" => $this->request->getVar('locationLat'),
        ]);

        $locationId = $this->db->insertID();

        $this->cinemaModel->save([
            "id" => $cinema["id"],
            "name" =>$this->request->getVar('name'),
            "location_id" =>$locationId,
        ]);


        session()->setFlashdata("success", "Modificación existosa");
        return redirect()->to(site_url('/cinemas'));
    }

    public function delete($id = null) {

        $whereCinemaFetch = "cinema.status = 1 AND location.status = 1";
        $cinema = $this->cinemaModel
        ->where($whereCinemaFetch)
        ->join("location", "location.id = cinema.location_id")
        ->find($id);

        if(!$cinema) {
            throw new Exception("Cine no encontrado");
        }

        $this->cinemaModel->save([
            "id" => $id,
            "status" => 0
        ]);

        $this->locationModel->save([
            "id" => $cinema["location_id"],
            "status" => 0
        ]);


        session()->setFlashdata('success', 'Cine eliminado');
        return redirect()->to(base_url('/cinemas'));
    }
    
}
