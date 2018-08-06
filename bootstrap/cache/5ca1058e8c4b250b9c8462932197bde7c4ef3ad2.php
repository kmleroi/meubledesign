<?php $__env->startSection('title','Product Category'); ?>
<?php $__env->startSection('data-page-id','exploreCategory'); ?>
<?php $__env->startSection('sectionTitle',$product->name); ?>
<?php $__env->startSection('sectionDesc','Mise à jour de la catégorie.'); ?>
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
                        <li class="breadcrumb-item">
                            <a href="/admin/categories/<?php echo e($product->category_id); ?>/"><?php echo e($product->category->name); ?></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/admin/subcategories/<?php echo e($product->Subcategory->id); ?>"><?php echo e($product->Subcategory->name); ?></a>
                        </li>
                        <li class="breadcrumb-item active">Edition de <?php echo e($product->name); ?></li>
                    </ol>
                    <div class="alert alert-danger fade show none notification" role="alert">
                        <strong class="msgNotification"></strong>
                    </div>
                    <div class="card-header">
                        <h6 class="card-title"> MODIFIER PRODUIT <?php echo e($product->name); ?></h6>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="d-flex justify-content-end">
                        <button class="mr-2 btn btn-info updateProduct">Enregistrer&nbsp; <i class="fas fa-check"></i></button>
                        <form action="/admin/subcategories/<?php echo e($product->Subcategory->id); ?>">
                            <button class="btn btn-danger">Fermer&nbsp; <i class="fas fa-times"></i></button>
                        </form>
                    </div>
                    <div class="card card-nav-tabs card-plain">
                        <div class="card-header card-header-danger">
                            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#descGen" data-toggle="tab">Description générale</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#seo" data-toggle="tab">SEO</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#imgs" data-toggle="tab">Images</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><div class="card-body ">
                            <div class="tab-content text-center">
                                <!-----Partie dédiée aux informations générale-------->
                                <div class="tab-pane active" id="descGen">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group text-left">
                                                <label for="nameCat" class="ml-2 mb-2 f700">Nom du produit<b>*</b> </label>
                                                <input type="texte" class="form-control form-controlBordered" id="nameProd" value="<?php echo e($product->name); ?>">
                                            </div>
                                            <div class="form-group text-left">
                                                <label for="nameCat" class="ml-2 mb-2 f700">Description</label>
                                                <textarea class="form-control textareaBordered" id="descCat" rows="10" ></textarea>
                                                <span class="help-block">Une courte description, utilisée lorsqu'un résumé ou une introduction est requise</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1" class="ml-2 mb-2 f700">Catégorie Parente</label>
                                                <select class="form-control form-controlBordered" id="catgory_id">
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($product->category_id == $cat->id): ?>
                                                            <option value="<?php echo e($cat->id); ?>" selected><?php echo e($cat->name); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="form-check mt-3">
                                                <label class="form-check-label f700">
                                                    <input class="form-check-input onLineCheck" type="checkbox" <?php if($product->view == 1): ?> value="1" checked <?php else: ?> value="0" <?php endif; ?> >
                                                    En Ligne
                                                    <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-----Partie dédiée aux infos SEO-------->

                                <div class="tab-pane" id="seo">
                                    <div class="form-group text-left">
                                        <label for="titleCat" class="ml-2 mb-2 f700">Titre de la page</label>
                                        <input type="texte" class="form-control form-controlBordered" id="titleCat" value="" placeholder="Assurez-vous d'avoir un titre clair et qui contient les mots-clés correspondant à la page en cours">
                                        <span class="help-block">L'élément HTML TITLE est le plus important dans votre page</span>
                                    </div>
                                    <div class="form-group text-left">
                                        <label for="metaDescCat" class="ml-2 mb-2 f700">Meta description</label>
                                        <textarea class="form-control textareaBordered" id="metaDescCat" rows="10"  placeholder="Assurez-vous d'avoir des mots-clés présents dans la page courante"></textarea>
                                        <span class="help-block">Votre description ne devrait pas dépasser 150 à 160 caractères</span>
                                    </div>
                                    <div class="form-group text-left">
                                        <label for="metaKeyCat" class="ml-2 mb-2 f700">Meta keywords</label>
                                        <textarea class="form-control textareaBordered" id="metaKeyCat" rows="10"  placeholder="Ne répétez pas sans cesse les mêmes mots-clés dans une lignes. Préférez utiliser des expressions de mots-clés. "></textarea>
                                        <span class="help-block">Vous n'avez pas besoin d'utiliser de virgules ou d'autres signes de ponctuation</span>
                                    </div>
                                </div>
                                <!-----Partie dédiée à l'image-------->
                                <div class="tab-pane text-center" id="imgs">
                                    <div class="apercu">
                                        <img src="/images/noimage.png" alt="">
                                    </div>
                                    <input type="text" value="noimage.png" id="imageCat" >
                                </div>
                                <input id="token" name="token" type="hidden" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                                <input id="idProdImage" name="idProd" type="hidden" value="<?php echo e($product->id); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <small class="m-3">Rubrique créée le <?php echo e($product->created_at); ?>. Dernière modification le <?php echo e($product->updated_at); ?></small>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>