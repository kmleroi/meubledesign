<?php $__env->startSection('title','Product Category'); ?>
<?php $__env->startSection('data-page-id','exploreCategory'); ?>
<?php $__env->startSection('sectionTitle',$categories->name); ?>
<?php $__env->startSection('sectionDesc','Affichage de la catégorie.'); ?>
<?php $__env->startSection('content'); ?>
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
                        <a href="/admin/categories">Catégories</a>
                    </li>
                    <li class="breadcrumb-item active"><?php echo e($categories->name); ?>&nbsp;<a href="/admin/categories/<?php echo e($categories->id); ?>/">(modification)</a></li>
                </ol>
                <div class="card-header">
                    <h4 class="card-title"> Sous-catégories</h4>
                </div>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="/admin/categories/addsubcat"  title="Ajouter une sous-catégorie">
                            <button class="btn btn-primary btn-fab btn-icon btn-round">
                                <i class="fas fa-plus"></i>
                            </button>
                        </a>
                    </div>
                </div>
                <?php if(count($subCat)): ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Position</th>
                            <th>Nom</th>
                            <th>En ligne</th>
                            <!--<th class="text-right">Salary</th>-->
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $subCat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($sub->position); ?></td>
                                <td>
                                    <a href="/admin/categories/<?php echo e($sub->id); ?>/open"> <?php echo e($sub->name); ?></a>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="" <?php if($sub->view): ?> checked <?php endif; ?>>
                                            <span class="form-check-sign"><span class="check"></span></span>
                                        </label>
                                    </div>
                                </td>
                                <td class="td-actions text-right d-flex justify-content-end">
                                    <a href="/admin/categories/<?php echo e($sub->id); ?>/open">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon mr-2">
                                            <i class="fa fa-folder-open"></i>
                                        </button>
                                    </a>
                                    <a href="/admin/categories/<?php echo e($sub->id); ?>/">
                                        <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon mr-2">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <form action="/admin/categories/<?php echo e($sub->id); ?>/delete" method="post">
                                        <input name="token" type="hidden" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                                        <input name="id" class="form-control"  type="hidden" value="<?php echo e($sub->id); ?>">
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon" onclick="return confirm('Êtes-vous sûr de votre choix ?')" >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-warning mt-3">
                        <span>
                            <b> Désolé - </b> Pas de sous-catégorie à afficher
                        </span>
                    </div>
                <?php endif; ?>
                <!--produit-->
                <div class="card-header">
                    <h4 class="card-title">Produits</h4>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="/admin/categories/addproduct" title="Ajouter un produit">
                            <button class="btn btn-primary btn-fab btn-icon btn-round">
                                <i class="fas fa-plus"></i>
                            </button>
                        </a>
                    </div>
                </div>
                <div>
                    <div class="alert alert-warning mt-3">
                        <span>
                            <b> Désolé - </b> Pas de produits à afficher
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>