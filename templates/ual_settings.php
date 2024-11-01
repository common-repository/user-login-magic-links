<select id="ual_time_limit" name="ual_time_limit">
	<?php for( $i = 5; $i <= 60; $i += 5 ): ?>
		<option <?php selected( $selected_time, $i ); ?> value="<?php echo $i; ?>"><?php printf( __( '%d Minutes', 'pitsual' ), $i ); ?></option>
	<?php endfor; ?>
</select>