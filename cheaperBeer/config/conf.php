<?php
class Conf{
	
	static $debug = 1; 

	static $databases = array(

	
            	'default' => array(
			'host'		=> 'localhost',
			'database'	=> 'cheapbeer',
			'login'		=> 'guizmauh',
			'password'	=> 'XGc8CzKedHTBDTGh'
		)
	);

        static $recapt_pub = '6LdyvOUSAAAAAILPjT76T3To4KB273J8sWNNwpIK';
        static $recapt_priv = '6LdyvOUSAAAAAAsuvNGOMT_zD1eEHkkIHUnlU4kC';

}
Router::prefix('bwabrille','admin');

Router::connect('','users/index');
Router::connect('bwabrille','bwabrille/posts/index');


Router::connect('login','users/login');
Router::connect('logout','users/logout');
Router::connect('signup','users/signups');
Router::connect('aboutus','users/view/1656564760');
Router::connect('complete-profile','users/complete');
Router::connect('password-recovery','users/forgot');
Router::connect('suscribe','users/premium');
Router::connect('suscribe/3-months','users/premium/1');
Router::connect('suscribe/6-months','users/premium/2');
Router::connect('suscribe/1-year','users/premium/3');

Router::connect('profile/:id','users/view/id:([0-9]+)');
Router::connect('my-profile','users/view');
Router::connect('edit-my-profile','users/edit');
Router::connect('community/:id','users/index/id:([0-9]+)');
Router::connect('community/:id-:name','users/index/id:([0-9]+)/name:([\(\)\'\@\&0-9a-zA-Z-_ ]+)');
Router::connect('communityof/:id','users/taglist/id:([0-9]+)');
Router::connect('community/:id','users/index/id:([0-9]+)');

Router::connect('about','posts/about');
Router::connect('term','posts/term');
Router::connect('privacy','posts/privacy');
Router::connect('help','posts/help');
Router::connect('contact','posts/contact');
Router::connect('settings','params/index');
Router::connect('settings/premium/:id','params/premium/id:([0-9]+)');
Router::connect('settings/*','params/*');



Router::connect('tag/delete/:id','categories/delete_tag/id:([0-9]+)');
Router::connect('community/add/:id','categories/tag/id:([0-9]+)');

Router::connect('write/:id','messages/write/id:([0-9]+)');
Router::connect('write/swa','messages/write/id:7514263');
Router::connect('messages','messages/index');
Router::connect('messages/unread','messages/index/347');

Router::connect('my-gallery','medias/pics');
Router::connect('gallery/:id','medias/pics/id:([0-9]+)');
Router::connect('photo/:user/:id','medias/view_pics/user:([0-9]+)/id:([0-9]+)');
Router::connect('photo/like/:user/:id','medias/like_picture/user:([0-9]+)/id:([0-9]+)');
Router::connect('photo/delete/:id','medias/pics_delete/id:([0-9]+)');
Router::connect('photo/avatar/:id','medias/pics_main/id:([0-9]+)');

Router::connect('page/:id-:slug','pages/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
