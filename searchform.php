<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" id="searchform">
    <fieldset>
        <div id="searchbox">
            <input type="text" name="s"  id="keywords" value="<?php _e( 'type here...' , 'treeson' ); ?>" onfocus="if (this.value == '<?php _e( 'type here...' , 'treeson' ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'type here...' , 'treeson' ); ?>';}">
            <button type="submit"><i class="icon-search-5"></i></button>
        </div>
    </fieldset>
</form>