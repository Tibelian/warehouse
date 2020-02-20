        </section>
    </main>
    
    <!-- javascript -->
    <script src="<?= BASE_URL; ?>/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= BASE_URL; ?>/assets/js/popper.min.js"></script>
    <script src="<?= BASE_URL; ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= BASE_URL; ?>/assets/js/main.js"></script>
    <?php
    // show extra js added to the view
    $jsList = View::getJs();
    foreach($jsList as $js){
        echo $js;
    }
    ?>

</body>
</html>