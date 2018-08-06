<?php $__env->startSection('title','Product Category'); ?>
<?php $__env->startSection('data-page-id','adminCategory'); ?>
<?php $__env->startSection('sectionTitle','Catégories'); ?>
<?php $__env->startSection('sectionDesc','Gestion de toutes les catégories de votre boutique.'); ?>
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
                        <li class="breadcrumb-item active">Catégories</li>
                    </ol>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-12 text-right">
                            <button class="btn btn-primary btn-fab btn-icon btn-round" data-toggle="modal" data-target="#addModal">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <?php if(count($categories)): ?>
                        <table class="table table-striped" id="catTable">
                            <thead>
                            <tr>
                                <th class="text-center">Position</th>
                                <th>Nom</th>
                                <th>En ligne</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="tr<?php echo e($category->id); ?>">
                                    <td class="text-center"><?php echo e($category->position); ?></td>
                                    <td>
                                        <a href="/admin/categories/<?php echo e($category->id); ?>/"> <?php echo e($category->name); ?></a>
                                    </td>
                                    <td>
                                        <!--<div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input activation" type="checkbox" <?php if($category->view ): ?> checked="checked"  <?php endif; ?> data-id="<?php echo e($category->id); ?>">
                                                <span class="form-check-sign"><span class="check"></span></span>
                                            </label>
                                        </div>-->
                                        <div class="">
                                            <div class="md-form">
                                                <div class="material-switch">
                                                    <input class="activation activation<?php echo e($category->id); ?>" id="switch-success<?php echo e($category->id); ?>" name="switch-success" type="checkbox" <?php if($category->view ): ?> value="1" checked="checked" <?php else: ?> value="0" <?php endif; ?> data-id="<?php echo e($category->id); ?>">
                                                    <label for="switch-success<?php echo e($category->id); ?>" class="success-color"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="td-actions text-right d-flex justify-content-end">
                                        <a href="/admin/categories/<?php echo e($category->id); ?>/">
                                            <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon mr-2">
                                                <i class="fa fa-folder-open"></i>
                                            </button>
                                        </a>
                                        <a href="/admin/categories/<?php echo e($category->id); ?>/edit">
                                            <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon mr-2">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon delButton" data-id ="<?php echo e($category->id); ?>" data-name ="<?php echo e($category->name); ?>" >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <input id="token<?php echo e($category->id); ?>" name="token" type="hidden" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                                    <!--<form action="/admin/categories/<?php echo e($category->id); ?>/delete" method="post">
                                            <input name="token" type="hidden" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                                            <input name="id" class="form-control"  type="hidden" value="<?php echo e($category->id); ?>">
                                            <button  type="submit" rel="tooltip" class="btn btn-danger btn-sm btn-icon" onclick="return confirm('Êtes-vous sûr de votre choix ?')" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>-->
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <div class="row mt-5">
                            <div class="col-10 offset-sm-1 alert alert-info">Pour créer un nouveau produit, veuillez sélectionner une rubrique existante ou en créer une nouvelle</div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <button type="button" aria-hidden="true" class="close">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </button>
                            <span>
                    <b> Désolé - </b> Pas de catégories à afficher</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="exampleModalLabel">Créer une nouvelle catégorie</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show none notification" role="alert">
                        <strong class="msgNotification"></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form>
                        <input id="token" name="token" type="hidden" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                        <div class="form-group">
                            <label for="nameCat">Nom de la catégorie</label>
                            <input type="texte" class="form-control " name="name" id="nameCat" aria-describedby="Nom" placeholder="Entrer ici le nom de la catégorie que vous souhaitez créer">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input name="online" id="onLine" class="form-check-input onLineCheck" type="checkbox" value="0">
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
                    <button id="newCatButton" type="button" class="btn btn-info"><i class="fas fa-check"></i>&nbsp;Créer cette catégorie</button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>