 <!-- Footer -->
 <div class="footer">

     <!-- <div style="width: 100px;"></div>  -->
     <div class="center-text">Panitia OSIS 2025</div>
     <div class="buttons">


     </div>
     <script>
         const logoutBtn = document.getElementById("logoutBtn");
         const logoutForm = document.getElementById("logoutForm");

         logoutBtn.addEventListener("click", function() {
             Swal.fire({
                 title: "Konfirmasi Logout",
                 text: "Apakah Anda yakin ingin keluar dari dashboard?",
                 icon: "warning",
                 showCancelButton: true,
                 confirmButtonColor: "#3085d6",
                 cancelButtonColor: "#d33",
                 confirmButtonText: "Ya, keluar",
                 cancelButtonText: "Batal"
             }).then((result) => {
                 if (result.isConfirmed) {
                     // Efek fade-out
                     document.body.classList.add("fade-out");

                     // Tampilkan loading overlay
                     Swal.fire({
                         title: "Sedang logout...",
                         html: `
                            <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                                <div style="width: 25px; height: 25px; border: 3px solid #ccc; border-top: 3px solid #3085d6; border-radius: 50%; animation: spin 1s linear infinite;"></div>
                                <span>Harap tunggu</span>
                            </div>
                        `,
                         showConfirmButton: false,
                         allowOutsideClick: false,
                         allowEscapeKey: false
                     });

                     // Delay untuk efek animasi
                     setTimeout(() => {
                         // Simulasi logout sukses sebelum redirect
                         Swal.fire({
                             icon: "success",
                             title: "Berhasil Logout!",
                             text: "Anda akan diarahkan ke halaman login...",
                             showConfirmButton: false,
                             timer: 2000,
                             willClose: () => {
                                 logoutForm.submit();
                             }
                         });
                     }, 1500);
                 }
             });
         });
     </script>
