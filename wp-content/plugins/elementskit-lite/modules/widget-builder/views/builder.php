<script>
    var ekitWidgetBuilder = {
        api: '<?php echo get_rest_url(); ?>elementskit/v1/widget-builder/',
        pull_id: <?php echo (int)(isset($_GET['post']) ? $_GET['post'] : 0);?>,
        nonce: '<?php echo wp_create_nonce( 'wp_rest' ); ?>',
        assets: {
            'wysiwyg': '<?php echo $this->url; ?>assets/img/wysiwyg.png',
            'noImagePreview': '<?php echo $this->url; ?>assets/img/no-image.png',
            'imagePreviewTrans': '<?php echo $this->url; ?>assets/img/transparent_bg.png'
        }
    };

    // console.log(ekitWidgetBuilder);
</script>
<div id="ekitWidgetBuilderApp"></div>
