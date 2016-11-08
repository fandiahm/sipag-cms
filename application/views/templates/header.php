<?php if($display_navbar == '1'): ?>
<nav class="navbar <?php echo $navbar; ?> navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
            <?php if($display_logo == '1'):?>
            <a data-scroll-nav="0" class="navbar-brand img" href="#/">
                <img src="<?php echo base_url(); ?><?php echo $site_logo; ?>" class="img-responsive">
            </a>
            <?php endif; ?>
            <a data-scroll-nav="0" class="navbar-brand" href="#/">
                <?php echo $site_name; ?>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav <?php echo $position; ?>">
                <?php if(isset($menu_link)): ?>
                    <?php if (count($menu_link) > 0): ?>
                        <?php echo $li; ?>
                    <?php else:?>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            
            <ul class="nav navbar-nav <?php echo $position; ?>">
                <?php foreach($menu->result() as $menu): ?>
                    <?php $number++; ?>
                    <li><a data-scroll-nav="<?php echo $number; ?>"><?php echo $menu->section_menu; ?></a></li>
                <?php endforeach;?>
                <?php if($contact_display == '1'):?>
                    <li><a data-scroll-nav="<?php echo $last_number; ?>">Contact</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<?php endif; ?>
