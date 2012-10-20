<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Workers extends Controller {

	public function action_index()
	{
            // loads all workers object from table
                $orm = ORM::factory('workers');
                $workers = $orm->find_all();
                $view = new View('workers/index');
                $view->header = "Pracownicy";
                $view->numofworkers=count($workers);
                // set "workers" object to view
                $view->workers=$workers;
                $this->response->body($view);
	}
        public function action_edit(){
            $view = new View('workers/editadd');
            $view->header = "Edytuj";
            $msg = '';
            //check if POST is set or not
            if(!isset($_POST['imie'])){
                $orm = ORM::factory('workers');
                $view->worker = $orm->where('idworkerses','=',$this->request->param('id'))->find();
            }else {
                //if POST was set
                $worker=new StdClass();
                $worker->imie=$_POST['imie'];
                $worker->nazwisko=$_POST['nazwisko'];
                $worker->stanowisko=$_POST['stanowisko'];
                $worker->pesel=$_POST['pesel'];
                $worker->idworkerses=$_POST['idworkerses'];
                
                //validation
                if($worker->imie=='') $msg='Imię nie może być puste!<br />';
                if($worker->nazwisko=='') $msg=$msg.'Imię nie może być puste!<br />';
                if($worker->stanowisko=='') $msg=$msg.'Stanowisko nie może być puste!<br />';
                if(11!==strlen($worker->pesel)) $msg=$msg.'Pesel ma złą długość!<br />';
                //check if pesel exist
                $checkpesel = ORM::factory('workers')->where('pesel','=',$worker->pesel)->find();
                if($checkpesel->idworkerses!=$worker->idworkerses and $checkpesel->idworkerses!=NULL)$msg=$msg.'Taki pesel już istnieje!<br />';
                
                //check msg - if is empty then update
                if($msg==''){
                    $msg = 'Dane zostały zaktualizowane!';
                    $orm = ORM::factory('workers')->where('idworkerses','=',$worker->idworkerses)->find();
                    $orm->imie=$worker->imie;
                    $orm->nazwisko=$worker->nazwisko;
                    $orm->pesel=$worker->pesel;
                    $orm->stanowisko=$worker->stanowisko;
                    $orm->update();
                    }
                $view->worker=$worker;
            }
            $view->msg=$msg;
            $this->response->body($view);
        }
        public function action_add(){
            $view = new View('workers/editadd');
            $view->header = "Dodaj";
            $worker=new stdClass();
            $worker->imie='';
            $worker->nazwisko='';
            $worker->idworkerses='';
            $worker->pesel='';
            $worker->stanowisko='';
            $msg='';
            if(isset($_POST['imie'])){
                $worker->imie=$_POST['imie'];
                $worker->nazwisko=$_POST['nazwisko'];
                $worker->stanowisko=$_POST['stanowisko'];
                $worker->pesel=$_POST['pesel'];
                $worker->idworkerses=$_POST['idworkerses'];
                
                //validation
                if($worker->imie=='') $msg='Imię nie może być puste!<br />';
                if($worker->nazwisko=='') $msg=$msg.'Imię nie może być puste!<br />';
                if($worker->stanowisko=='') $msg=$msg.'Stanowisko nie może być puste!<br />';
                if(11!==strlen($worker->pesel)) $msg=$msg.'Pesel ma złą długość!<br />';
                //check if pesel exist
                $checkpesel = ORM::factory('workers')->where('pesel','=',$worker->pesel)->count_all();
                if($checkpesel!=0)$msg=$msg.'Taki pesel już istnieje!<br />';
                
                //check msg - if is empty then add
                if($msg==''){
                    $msg = 'Pracownik został dodany!';
                    $orm = ORM::factory('workers');
                    $orm->imie=$worker->imie;
                    $orm->nazwisko=$worker->nazwisko;
                    $orm->pesel=$worker->pesel;
                    $orm->stanowisko=$worker->stanowisko;
                    $orm->create();
                    }
            }
            //$workers = ORM::factory('workers')->from($tables)->f;
            $view->msg=$msg;
            $view->worker=$worker;
            $this->response->body($view);
        }
        public function action_delete(){
            $view = new View('workers/delete');
            $view->header='Usuń';
            if($this->request->param('id')!=''){
                $orm = ORM::factory('workers')->where('idworkerses','=',$this->request->param('id'))->find();
                $view->msg='Usunięto pracownika: '.$orm->imie.' '.$orm->nazwisko.' o numerze pesel - '.$orm->pesel.'!';
                $orm->delete();
                $this->response->body($view);
            }else $this->request->redirect();
        }

} // End Welcome