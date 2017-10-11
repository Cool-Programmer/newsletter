<?php
	class NWS_Widget extends WP_Widget
	{
		public function __construct() {
			$widget_ops = [
				'classname' => 'NWS_Widget',
				'description' => 'Add newsletter functionality to your website',
			];
			parent::__construct( 'NWS_Widget', 'NWS Widget', $widget_ops );
		}

		public function form($instance)
		{
			echo $this->getAdminForm($instance);
		}

		private function getAdminForm($instance)
		{
			if (isset($instance['title'])) {
				$title = esc_attr($instance['title']);
			}else{
				$title = __('Newsletter subscriber', 'nws');
			}

			if (isset($instance['recipient'])) {
				$recipient = esc_attr($instance['recipient']);
			}else{
				$recipient = 'you@example.com';
			}

			if (isset($instance['subject'])) {
				$subject = esc_attr($instance['subject']);
			}else{
				$subject = __('New Subscriber', 'nws');
			}
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'nws'); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>">
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('recipient'); ?>"><?php _e('Recipient', 'nws'); ?></label>
				<input type="text" name="<?php echo $this->get_field_name('recipient'); ?>" value="<?php echo esc_attr($recipient); ?>" class="widefat" id="<?php echo $this->get_field_id('recipient'); ?>">
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('subject'); ?>"><?php _e('Subject', 'nws') ?></label>
				<input type="text" class="widefat" name="<?php echo $this->get_field_name('subject'); ?>" value="<?php echo esc_attr($subject); ?>" id="<?php echo $this->get_field_id('subject'); ?>">
			</p>
		<?php
		}


		public function update($new_instance, $old_instance)
		{
			$instance = [
				'title'     => (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '',
				'recipient' => (!empty($new_instance['recipient'])) ? strip_tags($new_instance['recipient']) : '',
				'subject'   => (!empty($new_instance['subject'])) ? strip_tags($new_instance['subject']) : ''
			];
			return $instance;
		}


		public function widget($args, $instance)
		{
			$fields = [
				'title' 	=> esc_attr($instance['title']),
				'recipient' => esc_attr($instance['recipient']),
				'subject'	=> esc_attr($instance['subject'])
			];

			echo $args['before_widget'];
			echo $args['before_title'];
			  	if (!empty($fields['title'])) {
			  		echo $fields['title'];
			  	}
			echo $args['after_title'];
				echo $this->displayNWSwidget($fields);
			echo $args['after_widget'];
		}

		private function displayNWSwidget($fields)
		{
			?>
			<div class="nws-widget">
				<div id="msg-wrap"></div>
				<form method="post" action="<?php echo plugins_url(); ?>/newsletter-subscriber/includes/newsletter-subscriber-mailer.php" id="subscriber-form">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" id="name" name="name" class="form-control">
					</div>

					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" id="email" name="email" class="form-control">
					</div>
					<br>
					<input type="hidden" name="recipient" value="<?php echo esc_attr($fields['recipient']); ?>">
					<input type="hidden" name="subject" value="<?php echo esc_attr($fields['subject']); ?>">
					<input type="submit" value="Subscribe" name="subscriber_submit" class="btn btn-primary">
				</form>
			</div>
			<?php
		}
	}