<?php $__env->startSection('title','Nouvelle Categorie'); ?>
<?php $__env->startSection('data-page-id','adminCategory'); ?>
<?php $__env->startSection('sectionTitle','Nouvelle Categorie'); ?>
<?php $__env->startSection('sectionDesc','Enregistrement d\'une nouvelle categorie.'); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('includes.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header ">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/admin">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/admin/categories">Categories</a>
                    </li>
                    <li class="breadcrumb-item active">Nouvelle catégorie</li>
                </ol>
            </div>
            <div class="card-body ">


            </div>
        </div>
    </div>
</div>

    <!--<div class="alert notification none alert-dismissible fade show" role="alert">
        <span class="msgNotification"></span>
    </div>
    <!-- Breadcrumbs-
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/admin/product/categories">Categories</a>
        </li>
        <li class="breadcrumb-item active">Nouvelle catégorie</li>
    </ol>
    <div class="row m-5">
        <div class="col-md-8 offset-md-2">
            <form action="/admin/product/categories" method="post">
                <div class="form-group">
                    <label>Nom de la catégorie</label>
                    <input id="nameCat" name="name" class="form-control" id="nomCat" type="text" placeholder="Entrer un nom">
                </div>
                <input id="token" name="token" type="hidden" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                <button id="newCatButton" type="button">Enregistrer</button>
            </form>
        </div>
    </div>


-->


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="exampleModalLabel">Modal title</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nom de la catégorie</label>
                        <input type="texte" class="form-control" id="addNameCategory" aria-describedby="Nom" placeholder="Entrer ici le nom de la catégorie que vous souhaitez créer">
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="">
                            Cette catégorie est en ligne
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Annuler</button>
                <button type="button" class="btn btn-info"><i class="fas fa-check"></i>&nbsp;Créer cette catégorie</button>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>