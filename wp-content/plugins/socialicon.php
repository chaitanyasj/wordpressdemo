<?php
    /*
    Plugin Name: Social icon widget
    Description: widget for getting social icons
    Version: 1
    Author: vijay
    */


class mywidget extends wp_widget
{
    function __construct(){
        parent::wp_widget(false,$name=__('z new widget'));
    }
    //TO DESIGN BACKEND FOR ADMIN
    function form()
    {
         $defaults = array( 'title' => __('Info', 'example'), 'name' => __('vijay', 'example'), 'show_info' => true );
        $instance = wp_parse_args( (array) $instance, $defaults );
        // Widget Title: Text Input  ?> 
        <p> 
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
         
        <!-- TEXT INPUT  -->
        <p>
            <label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Your Name:', 'example'); ?></label>
            <input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
        </p>
         
         
         <!-- CHECKBOX -->
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['show_info'], true ); ?> id="<?php echo $this->get_field_id( 'show_info' ); ?>" name="<?php echo $this->get_field_name( 'show_info' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'show_info' ); ?>"><?php _e('Display info publicly?', 'example'); ?></label>
        </p>
        <?php
    }
    //TO MAKE OPERATIONS
    function update( $new_instance, $old_instance ) 
    {
            $instance = $old_instance;
         
            //Strip tags from title and name to remove HTML
            $instance['title'] = strip_tags( $new_instance['title'] );
            $instance['name'] = strip_tags( $new_instance['name'] );
            $instance['show_info'] = $new_instance['show_info'];
            return $instance;
    }
    //TO DISPLAY DATA
    function widget($arg,$instance)
    {
        $title = apply_filters('widget_title', $instance['title'] );
        $name = $instance['name'];
        $show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;
         
        echo $before_widget;
         
        // Display the widget title 
        if ( $title )
            echo $before_title . $title . $after_title;
         
        //Display the name 
        if ( $name )
            printf( '<p>' . __('Hey their Sailor! My name is %1$s.', 'example') . '</p>', $name);
         
        if ( $show_info )
            printf( $name );
         
        echo $after_widget;
    }
    
}

add_action('widgets_init', function(){
    register_widget('mywidget');
});