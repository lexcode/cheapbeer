<?php

class MessagesController extends Controller {

    /**
     * Permet de récup la liste des catégories pour le blog
     * */
    
      function write($t=7514263){
          
        $this->request->norend=true;
        $lidd=0;
         if(isset($t)){
                $t=filter_var($t,FILTER_VALIDATE_INT);
                if($t==false){
                   $this->Session->setFlash($this->t('invalid_address'),'error');
                   $this->redirect(); 
                }
            }
            if(isset($_POST['lastid'])){
            $lidd=filter_var($_POST['lastid'],FILTER_VALIDATE_INT);
        if(isset($lidd)&&($lidd>0)){
        $lastid=$lidd;
        }     
            }
          
        $d=array();
        $perPage = 50;
        $this->loadModel('Message');
        
         
        $id= $this->Session->user('id');
        $psd= $this->Session->user('pseudo');
        
        $cond=array('id_my'=>$t,'id_other'=>$id,'view'=>0);
        $read=$this->Message->find(array('fields'=>'id','conditions'=>$cond));
       
        foreach($read as $v){
            $v->view=1;
            $this->Message->save($v);
        }
       
        $d['t']=$t;
       // $d['e']=$this->gettuser_info($t,'pseudo');
        
        
        if($this->request->data ){
            $this->request->data->message=trim($this->request->data->message);
           if(isset($this->request->data->message)&&($this->request->data->message!='') ){
              
            
    //debug($this->request->data) ; die() ;
    unset($this->request->data->lastid);
            $this->request->data->pseudo = $psd; 
            $this->request->data->id_my = $id;
            $this->request->data->id_other = $t;
            $this->request->data->wtalk = ($id+$t);
            $this->request->data->created = time();
            $this->Message->save($this->request->data);
            if($t!=7514263){
                $this->loadModel('Client');
                $client=$this->Client->findFirst(array(
                    'fields'=>'email,id',
                    'conditions'=>array('id'=>$t)));
               // $this->notificate('client_message',$client->email);
            }
            unset($this->request->data);
    } 
           }
            
                                                            
                                           
            
        
        $condition = '(id_my='.$id.' && id_other='.$t.') OR (id_my='.$t.' && id_other='.$id.')' ;
        
        $tot = $this->Message->findCount($condition);
        
       $d['page'] = ceil($tot / $perPage);
       if($d['page']>0){
        if($this->request->page<1||$this->request->page>$d['page']){$this->request->page=$d['page'];}
        
        $d['messages'] = $this->Message->find(array(
            'conditions' => $condition,
            'order' => 'created ASC',
           'limit' => ($perPage * ($this->request->page - 1)).','.$perPage
                ));
        if($this->request->page==$d['page']){
            $d['rqp']=2;}
            else{$d['rqp']=0;}
        
       }
       $rst=fmod($tot,$perPage);
     // print_r($tot);
        //print_r($d['messages']) ;
        if($rst-1>=0&&isset($d['messages'][$rst-1]->id)){
         $d['lid']=$d['messages'][$rst-1]->id;  
       }else{
          $d['lid']=$lidd; 
       }
       
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){
        
       if(!isset($lastid)){
          $lastid=1;
       }
          $condition2 = '((id_my='.$id.' && id_other='.$t.') OR (id_my='.$t.' && id_other='.$id.')) AND id >'.$lastid ;
        
        $lastpost = $this->Message->find(array(
            'conditions' => $condition2,
            'order' => 'created ASC'
            //'limit' => ($perPage * ($this->request->page - 1)) . ',' . $perPage
                ));
        $a=array();
         $a["result"] = "";
        
        foreach( $lastpost as $k=>$v){
            $a['result'].='<div class="row">
                    <div class="col-md-12">'.nl2br($v->message).'<br></div>
                    <span style="color:#cccccc; font-size:10px;">
                        '.date("M j,H:i",$v->created).'
                    </span>	
                 </div>
                <br>';
           // $a['result'].='<div class="clearfix"><img src="/mvc/img/'.$pcs->file_sq_mini.'"/><h3>'.$v->pseudo.'</h3><ul><li>'.$v->message.'</li><li>'.$v->created.'</li></ul></div> ' ;
            $a['lastid']=$v->id ;
        }
        $a['fail']='failed';
       if(empty($lastpost)){$a['lastid']=$lastid;}
      echo json_encode($a);
    } 
       
        
    }
    

/*

Copyright (c) 2009 Anant Garg (anantgarg.com | inscripts.com)

This script may be used for non-commercial purposes only. For any
commercial purposes, please contact the author at 
anant.garg@inscripts.com

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

*/
public function chat(){
define ('DBPATH','localhost');
define ('DBUSER','guizmauh_potam');
define ('DBPASS','q2#(_4ZD,+=A');
define ('DBNAME','guizmauh_babar');


session_start();

global $dbh;
$dbh = mysql_connect(DBPATH,DBUSER,DBPASS);
mysql_selectdb(DBNAME,$dbh);

if ($_GET['action'] == "chatheartbeat") { $this->chatHeartbeat(); } 
if ($_GET['action'] == "sendchat") { $this->sendChat(); } 
if ($_GET['action'] == "closechat") { $this->closeChat(); } 
if ($_GET['action'] == "startchatsession") { $this->startChatSession(); } 

if (!isset($_SESSION['chatHistory'])) {
	$_SESSION['chatHistory'] = array();	
}

if (!isset($_SESSION['openChatBoxes'])) {
	$_SESSION['openChatBoxes'] = array();	
}
}
function chatHeartbeat() {
	
	$sql = "select * from messages where (messages.id_other = '".mysql_real_escape_string($this->Session->User('id'))."' AND view = 0) order by id ASC";
	$query = mysql_query($sql);
	$items = '';

	$chatBoxes = array();

	while ($chat = mysql_fetch_array($query)) {

		if (!isset($_SESSION['openChatBoxes'][$chat['id_my']]) && isset($_SESSION['chatHistory'][$chat['id_my']])) {
			$items = $_SESSION['chatHistory'][$chat['id_my']];
		}

		$chat['message'] = $this->sanitize($chat['message']);

		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['id_my']}",
                        "p": "{$chat['pseudo']}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($_SESSION['chatHistory'][$chat['id_my']])) {
		$_SESSION['chatHistory'][$chat['id_my']] = '';
	}

	$_SESSION['chatHistory'][$chat['id_my']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['id_my']}",
                        "p": "{$chat['pseudo']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($_SESSION['tsChatBoxes'][$chat['id_my']]);
		$_SESSION['openChatBoxes'][$chat['id_my']] = array($chat['created'],$chat['pseudo']);
	}

	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
                   // debug($time) ; die() ;
			$now = time()-$time[0];
			$tim = date('g:iA M dS', $time[0]);

			$message = "Sent at $tim";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"p": "{$time[1]}",
"m": "{$message}"

},
EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"p": "{$time[1]}",
"m": "{$message}"
},
EOD;
			$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}
        //Model message lu
	$sql = "update messages set view = 1 where messages.id_other = '".mysql_real_escape_string($this->Session->User('id'))."' and view = 0";
	$query = mysql_query($sql);

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
}

function chatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

function startChatSession() {
	$items = '';
	if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			$items .= $this->chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
	}

header('Content-type: application/json');
?>
{
		"username": "<?php echo $this->Session->User('pseudo');?>",
		"items": [
			<?php echo $items;?>
        ]
}

<?php


	exit(0);
}

function sendChat() {
	$from = $this->Session->User('id');
        $pseudo =  $this->Session->User('pseudo');
	$to = $_POST['to'];
	$message = $_POST['message'];

        $wtalk=$from+$to;


	$_SESSION['openChatBoxes'][$_POST['to']] = array(time(),$pseudo);
	
	$messagesan = $this->sanitize($message);

	if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
		$_SESSION['chatHistory'][$_POST['to']] = '';
	}

	$_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
					   {
			"s": "1",
			"f": "{$to}",
                        "p": "{$pseudo}",
			"m": "{$messagesan}"
	   },
EOD;


	unset($_SESSION['tsChatBoxes'][$_POST['to']]);
        //Model function
	$sql = "insert into messages (messages.id_my,messages.id_other,messages.wtalk,messages.pseudo,messages.message,messages.created) values ('".mysql_real_escape_string($from)."', '".mysql_real_escape_string($to)."','".$wtalk."','".$pseudo."','".mysql_real_escape_string($message)."',".time().")";
	
        $query = mysql_query($sql);
     //   debug($query) ; die() ;
	echo "1";
	exit(0);
}

function closeChat() {

	unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
	exit(0);
}

function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}
}