
        <footer>
            <p>This is my footer</p>
            <!-- call the a menu from functions.php. in this case "Secondary". put php tag before wp_footer -->
            <?php wp_nav_menu(array('theme_location'=>'secondary')); ?>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>