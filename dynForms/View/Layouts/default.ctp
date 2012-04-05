<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE HTML >
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		/*
		Not Needed
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		*/
		/**
		 * Add developement version of scripts
		 * or Production version based on debug level
		 */
		$list_of_scripts = array(
			"debug"=>array(
				"js"=>array(
					'jquery-1.7.2',
					'bootstrap',
					'underscore',
					'backbone',
					'bootstrap-tooltip'
				),
				"css"=>array(
					'cake.generic',
					'bootstrap',
					'bootstrap-responsive'
				)
			),
			"production" =>array(
				"js"=>array(
					'jquery-1.7.2.min',
					'bootstrap.min',
					'underscore-min',
					'backbone-min',
					'bootstrap-tooltip'
				),
				"css"=>array(
					'cake.generic',
					'bootstrap.min',
					'bootstrap-responsive.min'
				)
			)
		);
		if(Configure::read('debug') > 0){
			$current_mode = "debug";
		}else{
			$current_mode = "production";
		}

		foreach ($list_of_scripts[$current_mode]["js"] as $key => $value) {
				echo $this->Html->script($value);
		}
			foreach ($list_of_scripts[$current_mode]["css"] as $key => $value) {
				echo $this->Html->css($value);
		}

		// Add this to any `view` recommended is View/Layouts/default.ctp
		
		/*
		    	WWW_ROOT generally refers to your webroot directory
		    	DS is usually '/'
		    	$this->params['controller'] returns controller name in lowercase 
		    	$this->params['action'] returns action name in lowercase 
		    	Refer 
		    		* http://book.cakephp.org/2.0/en/core-libraries/global-constants-and-functions.html
		    		* http://stackoverflow.com/a/1425219
		*/
		
		if (is_file( WWW_ROOT . 'js' . DS . $this->params['controller'] . DS . $this->params['action'] . '.js')) {
		        echo $this->Html->script($this->params['controller'].DS.$this->params['action']);
		}
		
		if (is_file(WWW_ROOT . 'css' . DS . $this->params['controller'] . DS . $this->params['action'] . '->css')) {
		        echo $this->Html->css($this->params['controller'].DS.$this->params['action']);
		}
		
		/*
				Where to place JS and CSS files
				APP_DIR/webroot/js/<lowercase_controller_name>/<lowercase_action_name>.js
				APP_DIR/webroot/css/<lowercase_controller_name>/<lowercase_action_name>->css
		
				Example
				APP_DIR/webroot/js/pages/index.js
				APP_DIR/webroot/css/pages/index->css
		*/ 
?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>
				<?php 
				if( AuthComponent::user('_id') || AuthComponent::user('id')  ){
					echo AuthComponent::user('email');
					echo $this->Html->link("logout", array(
					                       "controller" => "Users",
					                       "action" =>"logout"
					                       ),array("class"=>'btn')); 
				}
				?>
				<span>
				Server Time: <?php echo date("h:i:s") ?>
				</span>
			</h1>
			
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
	

</body>
</html>
