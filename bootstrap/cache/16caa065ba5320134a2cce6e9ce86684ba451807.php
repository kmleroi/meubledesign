<?php $__env->startSection('title','Nouvelle Categorie'); ?>
<?php $__env->startSection('content'); ?>
    <!-- page header -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Editer la catégorie</h1>
        </div>
    </div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/admin/product/categories">Catégories</a>
        </li>
        <li class="breadcrumb-item active">Edition de&nbsp;<?php echo e($categories->name); ?></li>
    </ol>
    <div class="alert notification none alert-dismissible fade show" role="alert">
        <span class="msgNotification"></span>
    </div>
<div class="row m-5">
    <!-- Liste des categories-->
    <div class="col-12 card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="/admin/product/categories/<?php echo e($categories->id); ?>/edit" method="post">
                            <div class="form-group">
                                <label>Nom de la catégorie</label>
                                <input name="name" class="form-control" id="nameCat" type="text" value="<?php echo e($categories->name); ?>">
                                <input name="id" class="form-control" id="idCat" type="hidden" value="<?php echo e($categories->id); ?>">
                            </div>
                            <input id="token" name="token" type="hidden" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                            <button type="button" id="editCatButton">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-12 card p-3">
        <h4>Sous-catégorie</h4>
        <?php if(count($subCat)): ?>
           <?php $__currentLoopData = $subCat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <p><?php echo e($sub->name); ?></p>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="alert alert-info">Cette rubrique n'a pas de sous-rubrique. Pour en créer une nouvelle, cliquez sur le bouton + ci-dessus.</div>
        <?php endif; ?>
    </div>
</div>






<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>