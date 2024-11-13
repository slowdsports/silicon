<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<style>
    .toastify {
        bottom: 12% !important;
        border-radius: 10px;
        box-shadow: 2px 2px 8px 2px #6366f1;
    }
    .toast-close {
         position: absolute;
         top: 8px;
         right: 8px;
         font-size: 16px;
         color: #fff;
         cursor: pointer;
    }
</style>

<script>
    window.addEventListener('load', function() {
        Toastify({
          close: true,
          text: "<?=$alertMessage?>",
          duration: 30000,
          gravity: "bottom",
          position: "right",
          stopOnFocus: true,
          style: {
            background: "linear-gradient(to right, #33354d, #6366f1)",
          },
          onClick: function(){} // Callback después del clic
        }).showToast();
    });
</script>