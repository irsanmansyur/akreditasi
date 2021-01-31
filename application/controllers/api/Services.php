<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
require FCPATH.'/vendor/autoload.php';
class Services extends CI_Controller {
	private $signature; 
	function __construct() {
		parent::__construct ();
		
		$uri = $this->uri->segment(1);
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper ( array (
				'url',
				'form',
				'language' 
		) );
		$this->load->model ( array (
									'm_api',
									'm_login',
									) 
							);
	}
	
	function index() {
		header ( "location: " . base_url () );
		die ();
	}
		
	function login(){
		$dataArray = array ( 
				'pic' => 'Api' 
		);
	
		$param = array(
				'username' =>  $this->input->post('username'),
				'password' =>  $this->input->post('password'),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			// function pengecekan login sebagai kasir
			$data = $this->m_api->login();
			if($data){
				unset($data->member_password);
				//var_dump($data); exit;
				$dataUser = ['userid'=>$data['userid'],
							'nama'=>$data['nama']];
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Login berhasil";
				$dataArray ['results']['profile'] = (array) $dataUser;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Username atau password salah";
				//$dataArray ['results']['profile'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	function register(){
		$dataArray = array ( 
				'pic' => 'Api' 
		);
	
		$param = array(
				"username"				=> $this->input->post('username'),
				"password"				=> $this->input->post('password'),
				"nama"					=> $this->input->post('nama')
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$insertArray = array(
				"username"				=> $this->input->post('username'),
				"password"				=> md5($this->input->post('password')),
				"nama"					=> $this->input->post('nama')
			);
			$insert = $this->db->insert("tbl_user", $insertArray);
			if($insert){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Register berhasil";
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Register gagal";
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}

	public function mining()
	{
		$post = $this->input->post();
		$param = ['username'=>$post['username']];
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$dataig = $this->getMedia($post['username']);
			if(empty($dataig)){
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg']	= "Username Tidak Valid";
				$dataArray ['results']['category'] = "";
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}else{
				foreach ($dataig as $key => $value) {
					$this->dataMinning['komentar_isi'] = $value['caption'];
					$proses = $this->doProccess();
					$kategori[$key] = $proses['kategori'];
				}

				foreach ($kategori as $key => $value) {
					if(empty($value)){
						//$kategori[$key] = "Tidak Ada Kategori";\
						unset($kategori[$key]);
					}
					
				}

				$max = max(array_count_values($kategori));
				$arr = array_count_values($kategori);
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg']	= "Berhasil Mendapatkan Data";
				$dataArray ['results']['category'] = strtoupper(array_keys($arr,$max )[0]);
				foreach ($dataig as $key => $value) {
					$cat = !empty($kategori[$key])?$kategori[$key]:"Tidak Ada Kategori";
					$value['kategori'] = strtoupper($cat);
					unset($value['foto']);
					$value['caption'] = mb_convert_encoding(substr($value['caption'], 0,100)."...", 'UTF-8', 'UTF-8');
					$dataArray ['results']['detail'][$key] = $value;
				}
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
			/*foreach (array_unique($kategori) as $key => $value) {
				array_count_values($value)
			}*/
		}else{
			$dataArray = array ( 
				'pic' => 'Api' 
			);
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}

		
	}


	public function getMedia($usernameig){
		$instagram = new \InstagramScraper\Instagram();
		$medias = $instagram->getMedias($usernameig, 25);
		$data=[];
		$i=1;
		foreach ($medias as $key => $media) {
			$data[$key]['caption'] 	= $media->getCaption();
			$data[$key]['foto']		= $media->getImageHighResolutionUrl();
		}
		return $data;
	}


	//Memproses per caption
	public function doProccess(){
		
		$dataTr = $this->db->from('tbl_post')->get()->result_array();
		$dataTraining = [];
		foreach ($dataTr as $key => $value) {
			$dataTraining[$value['post_id']] = $value;
		}
		//var_dump($dataTraining); exit;
		foreach ($dataTraining as $key => $value) {
			//var_dump($value); exit;
			$dataKomentar = (object)['komentar_isi'=>$value['caption']];
			// merubah semua kata menjadi huruf kecil
			$dataCaseFolding = $this->caseFolding($dataKomentar);
			// pemisahan persatu kata
			$dataTokenizing = $this->tokenizing($dataCaseFolding);
			// pemisahan penghapusan kata yang tidak memiliki bobot
			$dataStopword = $this->stopWord($dataTokenizing);
			// penghapusan prefix, suffix dan kawan2nya
			$dataStemming = $this->doStemming($dataStopword);
			$dataTraining[$key]['preposisi'] = $dataStemming->komentar_isi;
		}
		
		$datatfIdf = $this->tfIdf($dataTraining);

		$dataKomentar = (object)['komentar_isi'=>$this->dataMinning['komentar_isi']];
		// merubah semua kata menjadi huruf kecil
		$dataCaseFolding = $this->caseFolding($dataKomentar);
		// pemisahan persatu kata
		$dataTokenizing = $this->tokenizing($dataCaseFolding);
		// pemisahan penghapusan kata yang tidak memiliki bobot
		$dataStopword = $this->stopWord($dataTokenizing);
		// penghapusan prefix, suffix dan kawan2nya
		$dataStemming = $this->doStemming($dataStopword);
		$dataTerpilih['preposisi'] = $dataStemming->komentar_isi;


		$datanyaExp = explode("|", $dataTerpilih['preposisi']);
		$cocok = [];
		$masuk = [];
		foreach ($datanyaExp as $keys => $values) {
			if (!empty($datatfIdf[$values])) {
				if (!in_array($values, $masuk)) {
					$cocok[] = $datatfIdf[$values];
					$masuk[] = $values;
				}
			}
		}

		$jumlahDoc = [];
		foreach ($cocok as $keyz => $valuez) {
			foreach ($valuez['p'] as $keys => $values) {
				if (empty($jumlahDoc[$keys])) {
					$jumlahDoc[$keys] = $values;
				}else{
					$jumlahDoc[$keys] = round($jumlahDoc[$keys]*$values,5);
					if ($jumlahDoc[$keys]<0.0001) {
						$jumlahDoc[$keys] = 0;
					}
				}
			}
		}
		if (count($jumlahDoc)>0) {
			$keyMax = array_keys($jumlahDoc, max($jumlahDoc));
			$keyMax = str_replace("D", "", $keyMax[0]);
			$dataTerpilih['kategori'] = $dataTraining[$keyMax]['kategori'];
		}else{
			$dataTerpilih['kategori'] = "tidak memiliki kategori";
		}
		return $dataTerpilih;
	}

	//Meratakan huruf komentar menjadi huruf kecil
	function caseFolding($komentar)
	{
		$new = clone $komentar;
	 	$new->komentar_isi = strtolower($new->komentar_isi);
		return $new;
	}

	//Membagi kalimat menjadi kata
	function tokenizing($komentar)
	{
		$new = clone $komentar;
		$return = str_replace("\n", ' ', $new->komentar_isi);
		$return = str_replace(' ', '-', $return);
		$return = preg_replace('/[^A-Za-z0-9\-]/', '', $return);
		$return = str_replace('-', ' ', $return);
		$return =  str_replace(" ","|",$return);
		$return = explode('|', $return);
		foreach ($return as $keys => $values) {
			if (ctype_space($values)) {
				unset($return[$keys]);
			}
		}
		foreach ($return as $keys => $values) {
			if (empty($values)) {
				unset($return[$keys]);
			}
		}
		$return = implode('|', $return);
		$new->komentar_isi = $return;
		return $new;
	}

	//Menghilangkan kata yang tidak penting / tidak memiliki bobot
	function stopWord($komentar)
	{
		$kataStopWord = 'ada adalah adanya adapun agak agaknya agar akan akankah akhir akhiri akhirnya aku akulah amat amatlah anda andalah antar antara antaranya apa apaan apabila apakah apalagi apatah artinya asal asalkan atas atau ataukah ataupun awal awalnya bagai bagaikan bagaimana bagaimanakah bagaimanapun bagi bagian bahkan bahwa bahwasanya baik bakal bakalan balik banyak bapak baru bawah beberapa begini beginian beginikah beginilah begitu begitukah begitulah begitupun bekerja belakang belakangan belum belumlah benar benarkah benarlah berada berakhir berakhirlah berakhirnya berapa berapakah berapalah berapapun berarti berawal berbagai berdatangan beri berikan berikut berikutnya berjumlah berkali-kali berkata berkehendak berkeinginan berkenaan berlainan berlalu berlangsung berlebihan bermacam bermacam-macam bermaksud bermula bersama bersama-sama bersiap bersiap-siap bertanya bertanya-tanya berturut berturut-turut bertutur berujar berupa besar betul betulkah biasa biasanya bila bilakah bisa bisakah boleh bolehkah bolehlah buat bukan bukankah bukanlah bukannya bulan bung cara caranya cukup cukupkah cukuplah cuma dahulu dalam dan dapat dari daripada datang dekat demi demikian demikianlah dengan depan di dia diakhiri diakhirinya dialah diantara diantaranya diberi diberikan diberikannya dibuat dibuatnya didapat didatangkan digunakan diibaratkan diibaratkannya diingat diingatkan diinginkan dijawab dijelaskan dijelaskannya dikarenakan dikatakan dikatakannya dikerjakan diketahui diketahuinya dikira dilakukan dilalui dilihat dimaksud dimaksudkan dimaksudkannya dimaksudnya diminta dimintai dimisalkan dimulai dimulailah dimulainya dimungkinkan dini dipastikan diperbuat diperbuatnya dipergunakan diperkirakan diperlihatkan diperlukan diperlukannya dipersoalkan dipertanyakan dipunyai diri dirinya disampaikan disebut disebutkan disebutkannya disini disinilah ditambahkan ditandaskan ditanya ditanyai ditanyakan ditegaskan ditujukan ditunjuk ditunjuki ditunjukkan ditunjukkannya ditunjuknya dituturkan dituturkannya diucapkan diucapkannya diungkapkan dong dua dulu empat enggak enggaknya entah entahlah guna gunakan hal hampir hanya hanyalah hari harus haruslah harusnya hendak hendaklah hendaknya hingga ia ialah ibarat ibaratkan ibaratnya ibu ikut ingat ingat-ingat ingin inginkah inginkan ini inikah inilah itu itukah itulah jadi jadilah jadinya jangan jangankan janganlah jauh jawab jawaban jawabnya jelas jelaskan jelaslah jelasnya jika jikalau juga jumlah jumlahnya justru kala kalau kalaulah kalaupun kalian kami kamilah kamu kamulah kan kapan kapankah kapanpun karena karenanya kasus kata katakan katakanlah katanya ke keadaan kebetulan kecil kedua keduanya keinginan kelamaan kelihatan kelihatannya kelima keluar kembali kemudian kemungkinan kemungkinannya kenapa kepada kepadanya kesampaian keseluruhan keseluruhannya keterlaluan ketika khususnya kini kinilah kira kira-kira kiranya kita kitalah kok kurang lagi lagian lah lain lainnya lalu lama lamanya lanjut lanjutnya lebih lewat lima luar macam maka makanya makin malah malahan mampu mampukah mana manakala manalagi masa masalah masalahnya masih masihkah masing masing-masing mau maupun melainkan melakukan melalui melihat melihatnya memang memastikan memberi memberikan membuat memerlukan memihak meminta memintakan memisalkan memperbuat mempergunakan memperkirakan memperlihatkan mempersiapkan mempersoalkan mempertanyakan mempunyai memulai memungkinkan menaiki menambahkan menandaskan menanti menanti-nanti menantikan menanya menanyai menanyakan mendapat mendapatkan mendatang mendatangi mendatangkan menegaskan mengakhiri mengapa mengatakan mengatakannya mengenai mengerjakan mengetahui menggunakan menghendaki mengibaratkan mengibaratkannya mengingat mengingatkan menginginkan mengira mengucapkan mengucapkannya mengungkapkan menjadi menjawab menjelaskan menuju menunjuk menunjuki menunjukkan menunjuknya menurut menuturkan menyampaikan menyangkut menyatakan menyebutkan menyeluruh menyiapkan merasa mereka merekalah merupakan meski meskipun meyakini meyakinkan minta mirip misal misalkan misalnya mula mulai mulailah mulanya mungkin mungkinkah nah naik namun nanti nantinya nyaris nyatanya oleh olehnya pada padahal padanya pak paling panjang pantas para pasti pastilah penting pentingnya per percuma perlu perlukah perlunya pernah persoalan pertama pertama-tama pertanyaan pertanyakan pihak pihaknya pukul pula pun punya rasa rasanya rata rupanya saat saatnya saja sajalah saling sama sama-sama sambil sampai sampai-sampai sampaikan sana sangat sangatlah satu saya sayalah se sebab sebabnya sebagai sebagaimana sebagainya sebagian sebaik sebaik-baiknya sebaiknya sebaliknya sebanyak sebegini sebegitu sebelum sebelumnya sebenarnya seberapa sebesar sebetulnya sebisanya sebuah sebut sebutlah sebutnya secara secukupnya sedang sedangkan sedemikian sedikit sedikitnya seenaknya segala segalanya segera seharusnya sehingga seingat sejak sejauh sejenak sejumlah sekadar sekadarnya sekali sekali-kali sekalian sekaligus sekalipun sekarang sekarang sekecil seketika sekiranya sekitar sekitarnya sekurang-kurangnya sekurangnya sela selain selaku selalu selama selama-lamanya selamanya selanjutnya seluruh seluruhnya semacam semakin semampu semampunya semasa semasih semata semata-mata semaunya sementara semisal semisalnya sempat semua semuanya semula sendiri sendirian sendirinya seolah seolah-olah seorang sepanjang sepantasnya sepantasnyalah seperlunya seperti sepertinya sepihak sering seringnya serta serupa sesaat sesama sesampai sesegera sesekali seseorang sesuatu sesuatunya sesudah sesudahnya setelah setempat setengah seterusnya setiap setiba setibanya setidak-tidaknya setidaknya setinggi seusai sewaktu siap siapa siapakah siapapun sini sinilah soal soalnya suatu sudah sudahkah sudahlah supaya tadi tadinya tahu tahun tak tambah tambahnya tampak tampaknya tandas tandasnya tanpa tanya tanyakan tanyanya tapi tegas tegasnya telah tempat tengah tentang tentu tentulah tentunya tepat terakhir terasa terbanyak terdahulu terdapat terdiri terhadap terhadapnya teringat teringat-ingat terjadi terjadilah terjadinya terkira terlalu terlebih terlihat termasuk ternyata tersampaikan tersebut tersebutlah tertentu tertuju terus terutama tetap tetapi tiap tiba tiba-tiba tidak tidakkah tidaklah tiga tinggi toh tunjuk turut tutur tuturnya ucap ucapnya ujar ujarnya umum umumnya ungkap ungkapnya untuk usah usai waduh wah wahai waktu waktunya walau walaupun wong yaitu yakin yakni yang -';
		$kataStopWord = explode(' ', $kataStopWord);
		$new = clone $komentar;
		$return = preg_replace('/\b('.implode('|',$kataStopWord).')\b/','', $new->komentar_isi);
		$return = explode('|', $return);
		foreach ($return as $keys => $values) {
			if (empty($values) || $values == '-') {
				unset($return[$keys]);
			}
		}
		$new->komentar_isi = implode('|', $return);
		return $new;
	}

	//Menghilangkan imbuhan
	function doStemming($komentar)
	{
		$new = clone $komentar;
		$dataKomentar = explode('|', $new->komentar_isi);
		foreach ($dataKomentar as $keys => $values) {
			$dataKomentar[$keys] = $this->stemming($values);
		}
		$new->komentar_isi = implode('|', $dataKomentar);
		return $new;
	}


	//Menghitung TF/IDF
	function tfIdf($komentar)
	{
		//var_dump($komentar); exit;
		$dataPerkata = array();
		$jumlah_komentar = count($komentar);
		$checking = [];

		$docnya = [];
		foreach ($komentar as $key => $value) {
			$docnya["D".$value['post_id']] = 0;
		}

		$number = 0;
		foreach ($komentar as $key => $value) {
			$dataKomentar = explode('|', $value['preposisi']);
			foreach ($dataKomentar as $keys => $values) {
				if (in_array($values,$checking) == false) {
					$checking[] = $values;
					if (!empty($values)) {
					$perkata = array('kata'=> $values,'doc'=>$docnya,'df'=>0,'idf'=>0,'jumlah_doc'=>$jumlah_komentar,'tfidf'=>array(),'p'=>array());
					$dataPerkata[$values] = $perkata;
					$number++;
					}
				}
			}
		}

		foreach ($dataPerkata as $key => $value) {
			foreach ($komentar as $keys => $values) {
				$adaCuy = substr_count($values['preposisi'], $value['kata']);
				if ($adaCuy > 0) {
					$adaCuy = 1;
				}
				$dataPerkata[$key]['doc']["D".$values['post_id']] += $adaCuy;
				$dataPerkata[$key]['df'] += $adaCuy;
			}
			$dataPerkata[$key]['idf'] = round(log(($dataPerkata[$key]['jumlah_doc']/$dataPerkata[$key]['df']),4),5);
		}
		//echo $jumlah_komentar; exit;

		$datajumlah = array('w'=>array(),'perkalianp'=>array(),'pdoc'=>1/$jumlah_komentar,'perkalianprior'=>array(),'maxPrior'=>0);
		$jumlahtotalIdf = 0;

		foreach ($dataPerkata as $key => $value) {
			foreach ($value['doc'] as $keys => $values) {
				if (empty($datajumlah['w'][$keys])) {
					$datajumlah['w'][$keys] = 0;
				}
				if ($values > 0) {
					$datajumlah['w'][$keys] += $dataPerkata[$key]['idf'];
					$dataPerkata[$key]['tfidf'][$keys] = $dataPerkata[$key]['idf'];
				}else{
					$datajumlah['w'][$keys] += 0;
					unset($dataPerkata[$key]['doc'][$keys]);
					// $dataPerkata[$key]['tfidf'][$keys] = 0;
				}
			}
		}

		foreach ($dataPerkata as $key => $value) {
			foreach ($value['tfidf'] as $keys => $values) {
				$docnya[$keys] += $values;
			}
		}

		foreach ($dataPerkata as $key => $value) {
			foreach ($value['tfidf'] as $keys => $values) {
				$dataPerkata[$key]['p'][$keys] = round(($dataPerkata[$key]['doc'][$keys]+1)/($values+$docnya[$keys]),5);
			}
		}

		return $dataPerkata;
	}

	//fungsi untuk menghapus suffix seperti -ku, -mu, -kah, dsb
	function Del_Inflection_Suffixes($kata){ 
		$kataAsal = $kata;
		
		if(preg_match('/([km]u|nya|[kl]ah|pun)\z/i',$kata)){ // Cek Inflection Suffixes
			$__kata = preg_replace('/([km]u|nya|[kl]ah|pun)\z/i','',$kata);

			return $__kata;
		}
		return $kataAsal;
	}

	// Cek Prefix Disallowed Sufixes (Kombinasi Awalan dan Akhiran yang tidak diizinkan)
	function Cek_Prefix_Disallowed_Sufixes($kata){

		if(preg_match('/^(be)[[:alpha:]]+/(i)\z/i',$kata)){ // be- dan -i
			return true;
		}

		if(preg_match('/^(se)[[:alpha:]]+/(i|kan)\z/i',$kata)){ // se- dan -i,-kan
			return true;
		}
		
		if(preg_match('/^(di)[[:alpha:]]+/(an)\z/i',$kata)){ // di- dan -an
			return true;
		}
		
		if(preg_match('/^(me)[[:alpha:]]+/(an)\z/i',$kata)){ // me- dan -an
			return true;
		}
		
		if(preg_match('/^(ke)[[:alpha:]]+/(i|kan)\z/i',$kata)){ // ke- dan -i,-kan
			return true;
		}
		return false;
	}

	// Hapus Derivation Suffixes ("-i", "-an" atau "-kan")
	function Del_Derivation_Suffixes($kata){
		$kataAsal = $kata;
		if(preg_match('/(i|an)\z/i',$kata)){ // Cek Suffixes
			$__kata = preg_replace('/(i|an)\z/i','',$kata);
			if($this->cariKamusData($__kata)){ // Cek Kamus
				return $__kata;
			}else if(preg_match('/(kan)\z/i',$kata)){
				$__kata = preg_replace('/(kan)\z/i','',$kata);
				if($this->cariKamusData($__kata)){
					return $__kata;
				}
			}
	/*– Jika Tidak ditemukan di kamus –*/
		}
		return $kataAsal;
	}

	// Hapus Derivation Prefix ("di-", "ke-", "se-", "te-", "be-", "me-", atau "pe-")
	function Del_Derivation_Prefix($kata){
		$kataAsal = $kata;

		/* —— Tentukan Tipe Awalan ————*/
		if(preg_match('/^(di|[ks]e)/',$kata)){ // Jika di-,ke-,se-
			$__kata = preg_replace('/^(di|[ks]e)/','',$kata);
			
			if($this->cariKamusData($__kata)){
				return $__kata;
			}
			
			$__kata__ = $this->Del_Derivation_Suffixes($__kata);
				
			if($this->cariKamusData($__kata__)){
				return $__kata__;
			}
			
			if(preg_match('/^(diper)/',$kata)){ //diper-
				$__kata = preg_replace('/^(diper)/','',$kata);
				$__kata__ = $this->Del_Derivation_Suffixes($__kata);
			
				if($this->cariKamusData($__kata__)){
					return $__kata__;
				}
				
			}
			
			if(preg_match('/^(ke[bt]er)/',$kata)){  //keber- dan keter-
				$__kata = preg_replace('/^(ke[bt]er)/','',$kata);
				$__kata__ = $this->Del_Derivation_Suffixes($__kata);
			
				if($this->cariKamusData($__kata__)){
					return $__kata__;
				}
			}
				
		}
		
		if(preg_match('/^([bt]e)/',$kata)){ //Jika awalannya adalah "te-","ter-", "be-","ber-"
			
			$__kata = preg_replace('/^([bt]e)/','',$kata);
			if($this->cariKamusData($__kata)){
				return $__kata; // Jika ada balik
			}
			
			$__kata = preg_replace('/^([bt]e[lr])/','',$kata);	
			if($this->cariKamusData($__kata)){
				return $__kata; // Jika ada balik
			}	
			
			$__kata__ = $this->Del_Derivation_Suffixes($__kata);
			if($this->cariKamusData($__kata__)){
				return $__kata__;
			}
		}
		
		if(preg_match('/^([mp]e)/',$kata)){
			$__kata = preg_replace('/^([mp]e)/','',$kata);
			if($this->cariKamusData($__kata)){
				return $__kata; // Jika ada balik
			}
			$__kata__ = $this->Del_Derivation_Suffixes($__kata);
			if($this->cariKamusData($__kata__)){
				return $__kata__;
			}
			
			if(preg_match('/^(memper)/',$kata)){
				$__kata = preg_replace('/^(memper)/','',$kata);
				if($this->cariKamusData($kata)){
					return $__kata;
				}
				$__kata__ = $this->Del_Derivation_Suffixes($__kata);
				if($this->cariKamusData($__kata__)){
					return $__kata__;
				}
			}
			
			if(preg_match('/^([mp]eng)/',$kata)){
				$__kata = preg_replace('/^([mp]eng)/','',$kata);
				if($this->cariKamusData($__kata)){
					return $__kata; // Jika ada balik
				}
				$__kata__ = $this->Del_Derivation_Suffixes($__kata);
				if($this->cariKamusData($__kata__)){
					return $__kata__;
				}
				
				$__kata = preg_replace('/^([mp]eng)/','k',$kata);
				if($this->cariKamusData($__kata)){
					return $__kata; // Jika ada balik
				}
				$__kata__ = $this->Del_Derivation_Suffixes($__kata);
				if($this->cariKamusData($__kata__)){
					return $__kata__;
				}
			}
			
			if(preg_match('/^([mp]eny)/',$kata)){
				$__kata = preg_replace('/^([mp]eny)/','s',$kata);
				if($this->cariKamusData($__kata)){
					return $__kata; // Jika ada balik
				}
				$__kata__ = $this->Del_Derivation_Suffixes($__kata);
				if($this->cariKamusData($__kata__)){
					return $__kata__;
				}
			}
			
			if(preg_match('/^([mp]e[lr])/',$kata)){
				$__kata = preg_replace('/^([mp]e[lr])/','',$kata);
				if($this->cariKamusData($__kata)){
					return $__kata; // Jika ada balik
				}
				$__kata__ = $this->Del_Derivation_Suffixes($__kata);
				if($this->cariKamusData($__kata__)){
					return $__kata__;
				}
			}
			
			if(preg_match('/^([mp]en)/',$kata)){
				$__kata = preg_replace('/^([mp]en)/','t',$kata);
				if($this->cariKamusData($__kata)){
					return $__kata; // Jika ada balik
				}
				$__kata__ = $this->Del_Derivation_Suffixes($__kata);
				if($this->cariKamusData($__kata__)){
					return $__kata__;
				}
				
				$__kata = preg_replace('/^([mp]en)/','',$kata);
				if($this->cariKamusData($__kata)){
					return $__kata; // Jika ada balik
				}
				$__kata__ = $this->Del_Derivation_Suffixes($__kata);
				if($this->cariKamusData($__kata__)){
					return $__kata__;
				}
			}
				
			if(preg_match('/^([mp]em)/',$kata)){
				$__kata = preg_replace('/^([mp]em)/','',$kata);
				if($this->cariKamusData($__kata)){
					return $__kata; // Jika ada balik
				}
				$__kata__ = $this->Del_Derivation_Suffixes($__kata);
				if($this->cariKamusData($__kata__)){
					return $__kata__;
				}
				
				$__kata = preg_replace('/^([mp]em)/','p',$kata);
				if($this->cariKamusData($__kata)){
					return $__kata; // Jika ada balik
				}
				
				$__kata__ = $this->Del_Derivation_Suffixes($__kata);
				if($this->cariKamusData($__kata__)){
					return $__kata__;
				}
			}	
		}
		return $kataAsal;
	}

	//fungsi pencarian akar kata
	function stemming($kata){ 

		$cekKata = $this->cariKamusData($kata);
		if($cekKata == true){ // Cek Kamus
			return $kata; // Jika Ada maka kata tersebut adalah kata dasar
		}else{ //jika tidak ada dalam kamus maka dilakukan stemming
			$kata = $this->Del_Inflection_Suffixes($kata);
			if($this->cariKamusData($kata)){
				return $kata;
			}
			
			$kata = $this->Del_Derivation_Suffixes($kata);
			if($this->cariKamusData($kata)){
				return $kata;
			}
			
			$kata = $this->Del_Derivation_Prefix($kata);
			if($this->cariKamusData($kata)){
				return $kata;
			}
		}
		return $kata;
	}
	//Kamus kata dasar
	function cariKamusData($kata)
	{
		$katabaru = array();
		$katabaru['kata'] = $kata;
		$katabaru = (object) $katabaru;
		$new = clone $katabaru;
		$dataKamus = ["abadi","abai","abal-abal","abangan","abdi","abis","acuh","adab","adaptabilitas","adaptasi","adaptif","adat","adil","aditif","adu domba","aduhai","agamis","agresif","agresivitas","ahli","aib","ajaib","ajal","ajar","akrab","akseptabel","aktif","aktualisasi","akun","akur","akurat","akut","alami","alamiah","alergi","alhamdulillah","alim","alkohol","alot","aman","amanah","ambek","ambisius","amblas","ambrol","ambruk","amburadul","amoral","ampuh","ancam","andal","andil","aneh","angel","anggap","anggun","angkat","angkuh","aniaya","anjing","anjlok","anteng","anti","antik","antikarat","antisipatif","antre","antri","antuk","antusias","antusiasme","anugerah","anyar","aparat","aparatur","apatis","apek","apes","api","apik","aplikatif","apositif","apriori","arah","aral","area","argumentatif","arif","arogan","arogansi","aroma","aromatik","arsip","arti","artistik","arung","arus","asah","asal","asam","aset","asih","asing","asli","aspek","aspirasi","aspiratif","asri","asuh","asusila","asyik","atas","ateis","ateisme","atraksi","atraktif","atur","autentik","autentikasi","awas","awet","awur","awut","ayem","ayom","ayu","azab","azam","babi","baca","bacin","bagus","bahagia","bahas","bahaya","baik","bakhil","bakteri","balau","banci","bandel","bangga","bangsa","bangsat","banjir","bantai","banting","bantu","banyak","bareng","baru","basi","basmi","batuk","bawel","bebal","beban","bebas","becus","beda","bego","bejat","beken","belakang","beloon","benar","bencana","benci","bengek","bengis","bengkak","benjol","bentar","berabe","berai","berani","berantas","berat","berengsek","beres","beri","beringas","berisik","berkah","berontak","bersih","besar","beser","betah","betul","biadab","biang","biasa","biaya","bicara","bijak","bijaksana","bilang","bimbang","bina","binar","bingung","bisa","bising","bisu","blong","bobol","bobot","bobrok","bocor","bodoh","bohong","bokek","bolong","bolos","bom","borok","boros","bosan","brengsek","brilian","brutal","bual","buang","buas","bubar","budak","budek","budiman","bugar","bugil","buih","buka","bukan","bukti","bumbung","bumerang","bumi hangus","bumpet","buncah","buncit","bunga","bungkam","bungkuk","buntet","buntu","buntung","bunuh","buram","buron","buru","buruk","busuk","buta","butek","butuh","butut","cabul","cabut","cacat","caci","caci maki","cadas","cadel","cahaya","cakap","cakar","cakep","cakram","calo","calon","camping","canda","candu","canggih","canggung","cantik","cap","capai","cape","capek","caplok","cari","catat","cebol","cecunguk","cedal","cedera","cegah","cegat","cek","cekal","cekat","cekcok","cekik","ceking","cela","celah","celaka","celat","cemar","cemas","cemberut","cemburu","cemerlang","cemooh","cendekia","cendekiawan","cengeng","cepat","cerah","ceramah","cerdas","cerdik","cerewet","ceria","cerita","ceriwis","cermat","ceroboh","cespleng","cetek","cinta","cipta","citra","ciut","coblos","cocok","colong","comel","condong","congkak","contek","contoh","copet","copot","corak","coreng","coret","cuek","culas","culik","culun","cundang","cupet","curam","curang","curi","curiga","dablek","dalam","damai","damba","dapat","darurat","datar","daur ulang","daya","daya guna","daya upaya","debat","dedikasi","dedikatif","defensif","dehidrasi","dekat","deklarasi","demam","demen","demo","demokratis","demonstrasi","denda","dendam","dengar","dengki","depan","deras","destruktif","dewasa","dialogis","diam","didik","diktator","diktatorial","dilema","dinamik","dinamis","dingin","diplomatik","diplomatis","diri","diskriminasi","doa","dongkol","dongok","dosa","doyan","duel","duet","duga","duka","dukung","dungu","dunia","durhaka","durja","durjana","dusta","ecek","edan","edukatif","efektif","efisien","egoistis","ekonomis","eksistensi","elegan","elok","emoh","emosi","emosional","empati","empuk","enak","enek","enggak","enggan","enteng","erotik","erotis","etik","etika","etis","evolusioner","fanatik","fantastis","fasih","fasik","fatal","favorit","fenomenal","feodal","feodalistis","fitnah","fleksibel","flu","fokus","frontal","fundamentalistis","fungsi","futuristik","futuristis","gaduh","gagal","gagu","gaji","galak","galau","gampang","ganas","ganggu","ganjil","ganteng","garang","gatal","gawat","geblek","gecar","gejolak","gelap","gelo","gemang","gemar","gembel","gembeng","gembira","gemblung","gembos","gembrot","gembur","gemebyar","gemerlap","gemetar","gemilang","gemuk","gendeng","gendut","genit","genius","gerah","gerak","geram","gersang","gesit","getir","getun","giat","gigih","gila","girang","goblok","goda","golak","gontai","gotong","gotong royong","goyah","gratis","gres","grogi","gugup","gugur","gulita","guna","guncang","gundah","gusar","gusur","guyub","habis","hadir","hajar","hak","halal","halang","halau","halus","hambar","hampa","hancur","hancur luluh","hangat","hanif","hantam","hapus","haram","harap","harmonis","haru","harum","harus","hasad","hasil","hasud","hasut","hati","hawa","hebat","heboh","hedonisme","hemat","hengkang","henti","heran","heroik","hias","hidup","higienis","hina","hina dina","hiperseksual","hipersensitif","histeris","hitung","homoseksual","hormat","hujat","hukum","humanistis","humor","humoris","humoristis","iba","ibadah","idam","ideal","idealis","idealistis","idiot","idola","ihsan","ikhlas","ikhtiar","iklan","ikut","ilegal","ilmiah","imajinatif","imbang","imitasi","impoten","impresif","indah","indisipliner","individual","induk","infak","infertil","informasi","informatif","ingat","ingin","ingin tahu","ingkar","ingus","inisiatif","inkompeten","inovasi","inovatif","insaf","interaktif","intim","introspeksi","invalid","iri","iri hati","irit","ironis","islami","islamiah","islamis","istirahat","isu","iya","jabat","jadi","jaga","jago","jahanam","jahat","jahil","jalan","jangan","janggal","janji","jasa","jatuh","jauh","jawab","jawara","jaya","jebak","jeblok","jeblos","jeda","jelek","jeli","jelimet","jelita","jemu","jenak","jenaka","jenuh","jera","jernih","jerumus","jijik","jilat","jinak","jitu","jiwa","juang","juara","judek","judes","jujur","juling","jumud","junior","jurang","kabur","kacau","kacung","kagak","kaget","kagok","kagum","kaku","kalah","kalap","kalem","kalut","kampanye","kampret","kanker","kapital","kapitalis","kaprah","karib","karim","karimah","karisma","karismatik","karya","kasar","kasih","kasihan","kasus","kawan","kawin","kaya","kebal","kebiri","kece","kecele","kecewa","kecil","kecil hati","kecut","kedaluwarsa","kedip","kejam","kejang","keji","kejut","kekang","kelahi","kelam","kelas","keliru","kelola","keluar","keluh","kempes","kempis","kenal","kenang","kentut","keras","kerdil","kere","keren","kering","kerja","kerling","kerlip","keruh","kesah","kesal","kesan","kesatria","kesel","kesima","kesumat","ketemu","ketua","khawatir","khayal","khianat","khidmat","khilaf","khusyuk","kikuk","kinerja","kira","kisah","kisruh","kocak","komitmen","kompatibel","kompeten","kompetensi","kompetitif","komprehensif","komunikatif","komunis","kondusif","konflik","konfrontatif","kongkalikong","kongkret","konis","konkret","konsekuen","konsisten","kontra","kontradiktif","kontraproduktif","kontras","kontroversial","koplo","korban","koreksi","korup","korupsi","koruptor","kotor","koyak","kreatif","kriminal","krisis","kritik","kritis","kronis","kualat","kuasa","kuat","kucel","kufur","kumal","kuman","kumuh","kunci","kuno","kurang","kurus","kusam","kusut","labil","lacur","laik","laku","lalai","lama","lambat","lancang","lancar","landa","langgeng","langkah","langsung","lantang","lapar","lapuk","lara","larang","latih","lawan","layu","lebam","ledak","legit","lelah","lelet","lemah","lemas","lembek","lembut","lemes","lempar","lengkap","lepas","lesu","letih","letus","liar","licik","lihat","lilit","lindung","linglung","loba","lolos","loyal","loyalitas","luar","lucu","lugas","luka","luluh","lulus","lumpur","lunak","lunas","lunglai","lupa","lurus","lusuh","macet","mafia","mahal","main","maju","maki","makmur","maksiat","maksimal","maksimum","malas","maling","malu","mampu","mampus","manajemen","manfaat","mangkir","mangkus","manis","manjur","mantap","manut","manuver","marah","masalah","masam","masih","masuk","masyarakat","mati","mau","maut","mawas diri","melankolis","melas","meleset","memar","menang","mendung","merana","merdeka","milik","mimpi","minim","minimal","minimum","mirip","miris","miskin","modar","modus","moral","motivasi","muda","mudah","muhasabah","muka","mulia","multifungsi","multiguna","mulus","mumet","mumpuni","munafik","munajat","muncikari","muncul","mundur","mungkar","murah","muram","murung","musibah","muslihat","mustahil","musuh","nafsu","naik","nakal","napas","nasib","nasionalis","nasionalisme","negara","negarawan","neraka","ngeri","nikah","nikmat","nista","norak","normal","nyaman","nyata","obsesi","obsesif","ogah","onani","oposisi","optimis","optimisme","optimistis","orasi","otoriter","pacu","padam","paham","pahit","pahlawan","paksa","palsu","pamer","panas","pandai","pangku","panik","panjang","pantas","panutan","parah","partisipasi","pasif","pasti","patah","paten","patriotisme","patuh","patut","payah","pecah","pecat","pedih","peduli","pelit","pendek","penjara","penting","peran","percaya","perih","perilaku","perkara","perkasa","perkosa","perlu","perosok","persis","pesan","pesimis","pesimistis","petaka","pidato","pikat","pikir","pikun","pilar","pilih","pimpin","pinggir","pintar","piutang","plinplan","plus","politik","pongah","popularitas","populer","posisi","positif","praktis","praktisi","prediksi","preman","presiden","prima","pro","produktif","profesional","promosi","propaganda","provokasi","provokatif","pucat","pungli","pupus","putus","racun","raga","ragu","rahmat","rajam","rajin","rakus","rakyat","ramah","ramai","rampok","rancu","rapi","rapuh","rasa","real","realistis","reda","rehat","rekan","rekayasa","rela","relawan","relevan","religi","religius","rendah","repot","reputasi","resah","resmi","retak","riang","ringan","rintih","risau","riuh","rugi","rumit","rusak","ruwet","sabar","sadar","sadis","sah","sahabat","saing","sakit","saksi","sakti","salah","salam","salim","salut","sama","sambut","sampah","sandera","sanggup","sangka","sangkil","sangsi","sanksi","santai","santun","sapa","saran","sarana","sarkasme","saru","satu","saudagar","saudara","sayang","sebal","sebar","sebar luas","sebel","sedang","sedap","sedekah","sederhana","sedia","sedih","sedikit","sedu","segan","segar","segel","segera","sehat","sejahtera","sejarah","sejati","sejuk","sekap","sekarat","sekolah","seks","seksi","seksual","selamat","seleweng","selingkuh","selisih","semangat","sembelit","sembunyi","senang","sendu","sengal","sengau","sengketa","sengsem","senior","senonoh","sensasional","sentosa","sentral","senyum","sepah","sepi","serah","serakah","serius","seru","sesak","sesal","sesat","setan","seteru","setia","sia","siaga","sial","siap","sigap","sihir","sikap","siksa","silaturahmi","simak","simalakama","simpati","simpatik","sindir","singkap","singkir","sinis","sip","sirik","sirna","sistematis","skandal","skeptis","sobat","sohib","sok","sokong","sombong","sopan","sosial","sosialisasi","sosok","stres","suap","suara","subur","suci","suka","sukses","sulit","sumbar","sumpek","sungguh","supel","super","suram","surga","susah","susila","susut","syirik","syubhat","syukur","taat","tabrak","tahlil","tahmid","tahu","tak","takabur","takbir","takdir","takjub","takluk","takut","takwa","tamak","tamat","tambah","tampak","tampan","tanding","tanggap","tangguh","tanggung","tangis","tangkap","tangkas","target","tarik","tarung","tasbih","tata","tau","tawa","tawan","tebas","tegak","tegang","tegap","tegar","tegas","teguh","tegur","tekad","tekor","tekun","teladan","telanjang","telat","teledor","teliti","teman","temperamen","temperamental","temu","tenaga","tenang","tenar","tendensius","tenggelam","tepat","terampil","terang","terima","terjal","teror","teroris","tetap","tewas","tiada","tidak","tikus","tindak","tinggal","tinggi","tingkah","tipikal","titip","tobat","tolak","toleran","toleransi","tolol","top","total","tremor","tua","tulus","tunda","tunduk","tunjang","tunjuk","tuntas","turun","tutup","ulet","unggul","ungkap","untung","upaya","urus","usaha","usang","usik","usil","usung","usut","utama","visi","visioner","vital","vitamin","vulgar","wabah","waduh","wafat","wagu","wajar","wajib","walafiat","walah","waras","waris","wasiat","waspada","waswas","watak","wawas","wenang","wibawa","wilayah","wirid","wujud","ya","yakin","yatim","zakat","zalim","ziarah","zikir","zina","zindik","zionis","zionisme","zuhud","negeri","setuju","setgab","golput","kredibel","peluang","bersahaja","merosot","barokah","utang","hutang","kapabilitas","integritas","profesional","perangkap","aduh","capres","katrok","tauladan","lebay","pede","bloon","nilai","rubah","klaim"];
		if (array_search($new->kata, $dataKamus) == false) {
			return false;
		}else{
			return true;
		}
	}	
	
}