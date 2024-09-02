<script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
  window.deleteConfirm = function (url, entityType) {
    Swal.fire({
      icon: "warning",
      text: `Do you want to delete this ${entityType}?`,
      showCancelButton: true,
      confirmButtonText: "Delete",
      confirmButtonColor: "#e3342f",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: `Select Reason for Deleting ${entityType}`,
          input: "select",
          inputOptions: {
            reason1: "Reason 1",
            reason2: "Reason 2",
            reason3: "Reason 3",
            reason4: "Reason 4",
          },
          inputPlaceholder: "Select a reason",
          showCancelButton: true,
          inputValidator: (value) => {
            return new Promise((resolve) => {
              if (value === "") {
                resolve(`You need to select a reason for deleting ${entityType}`);
              } else {
                window.location.href = url;
              }
            });
          },
        });
      }
    });
  };
</script>
