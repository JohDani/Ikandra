
<h1>Vos documents</h1>
<div class="btnlist">
<button><i class="fas fa-list"></i> Liste</button>
<button><i class="fas fa-file"></i> Importer</button>
<button><i class="fas fa-file"></i> Exporter</button>
<button><i class="fas fa-plus-circle"></i> Creer</button> 
</div>
<br>


<br>
<div class="">
<div class="table container-fluid" >
    <table id="tables">
        <tr>
            <th class="c">#</th>
            <th><i class="fas fa-clock"></i> Date</th>
            <th class="tableElem"><i class="fas fa-file-text"></i> Nom fichier</th>
            <th class="tableElem"><i class="fas fa-users"></i> Importé par</th>
            <th class="tableElem">Dans</th>
            <th class="tableElem">Actions</th>
        </tr>
        <tr>
            <td class="c"><input type="checkbox" name="" id=""></td>
            <td class="tableElem">2022-202-200</td>
            <td class="tableElem"><i class="fas fa-file"></i> <span> <a href="">A.docx</a></span></td>
            <td class="tableElem"><i class="fas fa-user"></i> <span> <a href="">R. dr Danh</a></span></td>
            <td class="tableElem"><i class="fas fa-folder-open"></i> <span><a href="">Fichier Local</a></span></td>
            <td class="tableElem">
            <button class="download" ><i class="fas fa-download"></i></button>
            <button><i class="fas fa-trash"></i></button>
            <button><i class="fas fa-pencil-alt    "></i></button>
            </td>
        </tr>

        <tr>
            <td><input type="checkbox" name="" id=""></td>
            <td>2022-202-200</td>
            <td class="tableElem"><i class="fas fa-file"></i> <span> <a href="download=accueil.doc" download="aceeuil.doc">A.docx</a></span></td>
            <td class="tableElem"><i class="fas fa-user"></i> <span> <a href="">R. dr Danh</a></span></td>
            <td class="tableElem"><i class="fas fa-folder-open"></i> <span><a href="">Fichier Local</a></span></td>
            <td class="tableElem">
            <button onclick=""><i class="fas fa-download"></i></button>
            <button><i class="fas fa-trash"></i></button>
            <button><i class="fa fa-pen" aria-hidden="true"></i></button>
            
            </td>
        </tr>


    </table>
</div>
</div>

<style>


    a{
        text-decoration: none;
    }
    .table{
        width: 100%;
        overflow-x: auto;
    }

    table{
        width: 100%;
        border-spacing: 0;
        text-align: left;
        
    }

    /* th{
        box-shadow: 0.5px 1px 2px 0.5px;
        font-weight: lighter;
        font-style: italic;
        color: (170, 228, 255);
    } */



 
</style>


<?php

include_once "partials/foot.php";
?>