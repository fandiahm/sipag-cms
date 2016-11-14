<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Section content -->
<?php foreach($section as $section): ?>
    
    <?php if($section['sid']): ?>

        <!-- Section -->
        <div class="section <?php echo $section['class_section']; ?> <?php echo $section['class_gallery_section']; ?>" id="<?php echo $section['section_name']; ?>" 
        <?php echo $section['data_scroll_index']; ?> style="<?php echo $section['bgcolor']; ?>; <?php echo $section['bgimage']; ?>">
            
            <!-- Container -->
            <div class="container <?php echo $section['class_gallery_container']; ?> <?php echo $section['class_va_container']; ?>">
                
                <!-- Row -->
                <div class="row content-center <?php echo $section['class_gallery_row'] ?>">

                    <!-- IF section layout 1 column -->
                    <?php if($section['section_layout'] == '1'): ?>

                        <?php $this->load->view('templates/layout/section_layout_1', Array('sid' => $section['sid']));?>

                    <!-- IF section layout 2 column -->
                    <?php elseif($section['section_layout'] == '2'): ?>

                        <?php $this->load->view('templates/layout/section_layout_2', Array('sid' => $section['sid']));?>

                    <!-- IF section layout 3 column -->
                    <?php elseif($section['section_layout'] == '3'): ?>

                        <?php $this->load->view('templates/layout/section_layout_3', Array('sid' => $section['sid']));?>

                    <!-- IF section layout 4 column -->
                    <?php elseif($section['section_layout'] == '4'): ?>

                        <?php $this->load->view('templates/layout/section_layout_4', Array('sid' => $section['sid']));?>

                    <!-- IF section layout 5 column -->
                    <?php elseif($section['section_layout'] == '5'): ?>

                        <?php $this->load->view('templates/layout/section_layout_5', Array('sid' => $section['sid']));?>

                    <!-- IF section layout 6 column -->
                    <?php elseif($section['section_layout'] == '6'): ?>

                        <?php $this->load->view('templates/layout/section_layout_6', Array('sid' => $section['sid']));?>

                    <!-- IF section layout left image -->
                    <?php elseif($section['section_layout'] == '21'): ?>

                        <?php $this->load->view('templates/layout/section_layout_21', Array('sid' => $section['sid']));?>

                    <!-- IF section layout right image -->
                    <?php elseif($section['section_layout'] == '22'): ?>

                        <?php $this->load->view('templates/layout/section_layout_22', Array('sid' => $section['sid']));?>

                    <!-- IF section layout gallery 2 column -->
                    <?php elseif($section['section_layout'] == '31'): ?>

                        <?php $this->load->view('templates/layout/section_layout_31', Array('sid' => $section['sid']));?>

                    <!-- IF section layout gallery 3 column -->
                    <?php elseif($section['section_layout'] == '32'): ?>

                        <?php $this->load->view('templates/layout/section_layout_32', Array('sid' => $section['sid']));?>

                    <!-- IF section layout gallery 4 column -->
                    <?php elseif($section['section_layout'] == '33'): ?>

                        <?php $this->load->view('templates/layout/section_layout_33', Array('sid' => $section['sid']));?>

                    <?php endif; ?>
                    <!-- END of IF section layout-->

                </div>
            </div>
        </div>
    <?php endif;?>
<?php endforeach;?>


<a href="#" class="scrollToTop">
    <i class="fa fa-angle-double-up"></i>
</a>