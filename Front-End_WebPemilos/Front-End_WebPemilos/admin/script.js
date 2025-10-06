document.addEventListener('DOMContentLoaded', function() {
    const btnMurid = document.getElementById("btnMurid");
    const btnGuru = document.getElementById("btnGuru");
    const tableMurid = document.getElementById("tableMurid");
    const tableGuru = document.getElementById("tableGuru");
    
    tableMurid.style.display = "table";
    tableGuru.style.display = "none";

    btnMurid.addEventListener("click", () => {
        tableMurid.style.display = "table";
        tableGuru.style.display = "none";
        document.querySelector(".table-section h2").style.display = "block";
        document.querySelectorAll(".table-section h2")[1].style.display = "none";
    });

    btnGuru.addEventListener("click", () => {
        tableMurid.style.display = "none";
        tableGuru.style.display = "table";
        document.querySelector(".table-section h2").style.display = "none";
        document.querySelectorAll(".table-section h2")[1].style.display = "block";
    });
});
