<footer id="footer">
    <div class="full-container">
        <div class="row">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Col 1") ) : endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Col 2") ) : endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Col 3") ) : endif; ?>
        </div>
    </div>
</footer>
<footer id="copyright">
    <div class="full-container">
        &copy; <?php echo esc_html(date_i18n(__('Y', 'matysanchez'))); ?> <?php echo esc_html(get_bloginfo('name')); ?>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>