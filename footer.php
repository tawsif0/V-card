<script src="./assests/js/sweet.js"></script>


<?php
if (isset($_SESSION['status']) && $_SESSION['status_code'] != '') {
?>
    <script>
        swal({
            title: "<?php echo $_SESSION['status']; ?>",

            icon: "<?php echo $_SESSION['status_code']; ?>",
            button: "Ok",
        });
    </script>
<?php
    unset($_SESSION['status']);
}
?>

</body>

</html>