
                <div class="overlay-imageSingle">
                    <?php the_content(); ?>

                    <div class="hoverSingle">

                    
                        <img class="full_screen" src="<?php echo get_template_directory_uri(); ?>/assets/Icon_fullscreen.png" alt="full_screen">
                                       


                    <a class="eye" href="<?php the_permalink(); ?>"><img  src="<?php echo get_template_directory_uri(); ?>/assets/Icon_eye.png" alt="eye">
                        </a>
                        <div class="texte">
                        <div class="ref-box"><?php  the_field('reference'); ?></div>
                        <div class="cat-box"><?php echo get_the_term_list(get_the_ID(),'categories',); ?></div>
                        </div>
                    </div>
                </div>
        

