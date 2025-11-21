        <br>
        <div id="footer">
            <?php echo 'Created by Steven Yuan for CS 84A, Dr. Kofi Weusijana, Fall 2025, Foothill College' ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
    $( function() {
      var $DEBUG = false;
      var $dob = $("#dob");
      if($dob){
        $dob.datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        dateFormat: "yy-mm-dd"
      }); 
      if($DEBUG) console.log("$dob:",$dob);
      }
    } );
    </script>
  </body>
</html>