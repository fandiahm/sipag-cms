<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Section content -->
<?php foreach($section->result() as $section): ?>
    
    <?php 

    $sid            = $section->section_id;
    $section_name   = $section->section_name;
    $section_layout = $section->section_layout;
    
    $auto_height = $section->auto_height;
    if($auto_height == '1')
    { 
        $class_section =  "section-auto"; 
    } 
    else 
    { 
        $class_section = "section-normal"; 
    }

    $layout = $section->section_layout;
    if(($layout == '31') OR ($layout == '32') OR ($layout == '33'))
    { 
        $class_gallery_section      = "section-gallery"; 
        $class_gallery_container    = "container-gallery";
        $class_gallery_row          = "row-gallery";
    }
    else
    {
        $class_gallery_section      = "";
        $class_gallery_container    = "";
        $class_gallery_row          = "";
    }

    if($section->display_menu == '1')
    { 
        $number++; 
        $data_scroll_index =  'data-scroll-index="'.$number.'"'; 
    }
    else
    {
        $data_scroll_index = '';
    }

    $section_bgimage = $section->bgimage;
    if(!empty($section_bgimage) && ($use_bgimage == '1'))
    {
        $bgimage = 'background-image:url('.base_url().''.$section_bgimage.'); background-size:cover';
    } 
    else
    {
        $bgimage = '';
    }

    $section_bgcolor = $section->bgcolor;
    if(!empty($section_bgcolor) && ($use_bgcolor == '1'))
    {
        $bgcolor = 'background-color:'.$section_bgcolor.'';
    }
    else
    {
        $bgcolor = '';
    }

    $section_va = $section->vertical_align;
    if($section_va == '1')
    {
        $class_va_container = "vertical-align";
    }
    else
    {
        $class_va_container = "";
    }

    ?>
    
    <?php if($sid): ?>

        <!-- Section -->
        <div class="section <?php echo $class_section; ?> <?php echo $class_gallery_section; ?>" id="<?php echo $section_name; ?>" 
        <?php echo $data_scroll_index; ?> style="<?php echo $bgcolor; ?>; <?php echo $bgimage; ?>">
            
            <!-- Container -->
            <div class="container <?php echo $class_gallery_container; ?> <?php echo $class_va_container; ?>">
                
                <!-- Row -->
                <div class="row content-center <?php echo $class_gallery_row ?>">

                    <!-- IF section layout 1 column -->
                    <?php if($section_layout == '1'): ?>

                        <?php $this->load->view('templates/layout/section_layout_1', Array('sid' => $sid));?>

                    <!-- IF section layout 2 column -->
                    <?php elseif($section_layout == '2'): ?>

                        <?php $this->load->view('templates/layout/section_layout_2', Array('sid' => $sid));?>

                    <!-- IF section layout 3 column -->
                    <?php elseif($section_layout == '3'): ?>

                        <?php $this->load->view('templates/layout/section_layout_3', Array('sid' => $sid));?>

                    <!-- IF section layout 4 column -->
                    <?php elseif($section_layout == '4'): ?>

                        <?php $this->load->view('templates/layout/section_layout_4', Array('sid' => $sid));?>

                    <!-- IF section layout 5 column -->
                    <?php elseif($section_layout == '5'): ?>

                        <?php $this->load->view('templates/layout/section_layout_5', Array('sid' => $sid));?>

                    <!-- IF section layout 6 column -->
                    <?php elseif($section_layout == '6'): ?>

                        <?php $this->load->view('templates/layout/section_layout_6', Array('sid' => $sid));?>

                    <!-- IF section layout left image -->
                    <?php elseif($section_layout == '21'): ?>

                        <?php $this->load->view('templates/layout/section_layout_21', Array('sid' => $sid));?>

                    <!-- IF section layout right image -->
                    <?php elseif($section_layout == '22'): ?>

                        <?php $this->load->view('templates/layout/section_layout_22', Array('sid' => $sid));?>

                    <!-- IF section layout gallery 2 column -->
                    <?php elseif($section_layout == '31'): ?>

                        <?php $this->load->view('templates/layout/section_layout_31', Array('sid' => $sid));?>

                    <!-- IF section layout gallery 3 column -->
                    <?php elseif($section_layout == '32'): ?>

                        <?php $this->load->view('templates/layout/section_layout_32', Array('sid' => $sid));?>

                    <!-- IF section layout gallery 4 column -->
                    <?php elseif($section_layout == '33'): ?>

                        <?php $this->load->view('templates/layout/section_layout_33', Array('sid' => $sid));?>

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