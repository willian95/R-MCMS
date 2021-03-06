@extends("layouts.main")

@section("content")

    <div class="d-flex flex-column-fluid" id="dev-products">
        <div class="loader-cover-custom" v-if="loading == true">
			<div class="loader-custom"></div>
		</div>
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Editar producto
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Título</label>
                                <input type="text" class="form-control" v-model="name">
                                <small v-if="errors.hasOwnProperty('name')">@{{ errors['name'][0] }}</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">Categoría</label>
                                <div style="display:flex">
                                    <select id="category" class="form-control" v-model="category">
                                        <option :value="category.id" v-for="category in categories">@{{ category.name }} - @{{ category.dog_category ? 'caninos' : '' }} @{{ category.cat_category ? 'felinos' : '' }}</option>
                                    </select>
                                </div>
                                <small v-if="errors.hasOwnProperty('category')">@{{ errors['category'][0] }}</small>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="brand">Marcas</label>
                                <div style="display:flex">
                                    <select id="brand" class="form-control" v-model="brand">
                                        <option :value="brand.id" v-for="brand in brands">@{{ brand.name }}</option>
                                    </select>
                                </div>
                                <small v-if="errors.hasOwnProperty('brand')">@{{ errors['brand'][0] }}</small>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Imágen (jpg, png | Dimensiones recomendadas: 1024x900px | max: 8 Mb )</label>
                                <input type="file" class="form-control" ref="file" @change="onMainImageChange" accept="image/*" style="overflow: hidden;">

                                <img id="blah" :src="imagePreview" class="full-image" style="margin-top: 10px; width: 40%">

                                <div v-if="pictureStatus == 'subiendo'" class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="{'width': `${imageProgress}%`}">
                                    @{{ imageProgress }}%
                                </div>

                                <p v-if="pictureStatus == 'subiendo' && imageProgress < 100">Subiendo</p>
                                <p v-if="pictureStatus == 'subiendo' && imageProgress == 100">Espere un momento</p>
                                <p v-if="pictureStatus == 'listo' && imageProgress == 100">Imágen lista</p>

                                <small v-if="errors.hasOwnProperty('image')">@{{ errors['image'][0] }}</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Imágen hover (jpg, png | Dimensiones recomendadas: 1024x900px | max: 8 Mb )</label>
                                <input type="file" class="form-control" ref="file" @change="onHoverImageChange" accept="image/*" style="overflow: hidden;">

                                <img id="blah" :src="imageHoverPreview" class="full-image" style="margin-top: 10px; width: 40%">

                                <div v-if="pictureHoverStatus == 'subiendo'" class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="{'width': `${imageHoverProgress}%`}">
                                    @{{ imageHoverProgress }}%
                                </div>

                                <p v-if="pictureHoverStatus == 'subiendo' && imageHoverProgress < 100">Subiendo</p>
                                <p v-if="pictureHoverStatus == 'subiendo' && imageHoverProgress == 100">Espere un momento</p>
                                <p v-if="pictureHoverStatus == 'listo' && imageHoverProgress == 100">Imágen lista</p>

                                <small v-if="errors.hasOwnProperty('image')">@{{ errors['image'][0] }}</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea rows="3" id="editor1">{!! $product->description !!}</textarea>
                                <small v-if="errors.hasOwnProperty('description')">@{{ errors['description'][0] }}</small>
                            </div>
                        </div>

                    </div>
                    <!---->
                    <div class="row">
                        <div class="col-12">
                        <h3 class="text-center">Contenido secundario <button class="btn btn-success" data-toggle="modal" data-target="#secondaryImagesModal">+</button></h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <table class="table table-bordered table-checkable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Imágen</th>
                                        <th>Progreso</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(workImage, index) in workImages">
                                        <td>@{{ index + 1 }}</td>

                                        <td>
                                            <img v-if="workImage.type == 'image'" :src="workImage.image" style="width: 40%;">
                                            <video class="w-100" controls v-if="workImage.image != '' && workImage.type == 'video'">
                                                <source :src="workImage.image" type="video/mp4">
                                                <source :src="workImage.image" type="video/ogg">
                                                Your browser does not support the video tag.
                                            </video>
                                        </td>
                                        <td>

                                            <div v-if="workImage.status == 'subiendo'" class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="{'width': `${workImage.progress}%`}">
                                                @{{ workImage.progress }}%
                                            </div>

                                            <p v-if="workImage.status == 'subiendo' && workImage.progress < 100">Subiendo</p>
                                            <p v-if="workImage.status == 'subiendo' && workImage.progress == 100">Espere un momento</p>
                                            <p v-if="workImage.status == 'listo' && workImage.progress == 100">Contenido listo</p>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" @click="deleteWorkImage(index)"><i class="far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>


                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h3 class="text-center">Presentaciones <button class="btn btn-success" data-toggle="modal" data-target="#presentationModal" @click="createProductFormat()">+</button></h3>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">

                            <table class="table table-bordered table-checkable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Color</th>
                                        <th>Talla</th>
                                        <th>Precio</th>
                                        <th>Precio de dto.</th>
                                        <th>Stock</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(productFormatSize, index) in productFormatSizes">
                                        <td>@{{ index + 1 }}</td>
                                        <td>@{{ productFormatSize.color.color }}</td>
                                        <td>@{{ productFormatSize.size.size }}</td>
                                        <td>$ @{{ number_format(productFormatSize.price, 0, ",", ".") }}</td>
                                        <td>$ @{{ number_format(productFormatSize.discount_price, 0, ",", ".") }}</td>
                                        <td>@{{ productFormatSize.stock }}</td>
                                        <td>
                                            <button class="btn btn-info" @click="editProductFormat(productFormatSize, index)" data-toggle="modal" data-target="#presentationModal"><i class="far fa-edit"></i></button>
                                            <button class="btn btn-danger" @click="deleteProductFormatSize(index)"><i class="far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <p class="text-center">
                                <button class="btn btn-success" @click="update()">Actualizar</button>
                            </p>
                        </div>
                    </div>


                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->



        <!-- Modal-->
        <div class="modal fade" id="presentationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Presentación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="type">Color</label>
                                    <div style="display:flex;">
                                        <select id="type" class="form-control" v-model="color">
                                            <option :value="color.id" v-for="color in colors">@{{ color.color }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="size">Talla</label>
                                    <div style="display:flex;">
                                        <select id="size" class="form-control" v-model="size">
                                            <option :value="size.id" v-for="size in sizes">@{{ size.size }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="price">Precio</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" v-model="price" @keypress="isNumberDot($event)">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="price">Precio de dto.</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" v-model="discountPrice" @keypress="isNumberDot($event)">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="price">Stock</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" v-model="stock" @keypress="isNumberDot($event)">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-success" @click="addProductColor()" v-if="productFormatModalAction == 'create'">Añadir</button>
                        <button class="btn btn-success" @click="updateProductColor()" v-if="productFormatModalAction == 'edit'">Actualaizar</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal-->
        <div class="modal fade" id="secondaryImagesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar imágen secundaria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="type">Imágen o vídeo (jpg, png, mp4 | Dimensiones recomendadas: 1024x900px | max: 8 Mb )</label>
                                    <input type="file" class="form-control" ref="file" @change="onSecondaryImageChange" accept="image/* | video/*" style="overflow: hidden;">

                                    <img id="blah" :src="secondaryPreviewPicture" v-if="secondaryPreviewPicture != '' && secondaryFileType == 'image'" class="full-image" style="margin-top: 10px; width: 40%">

                                    <video class="w-100" controls v-if="secondaryPreviewPicture != '' && secondaryFileType == 'video'">
                                        <source :src="secondaryPreviewPicture" type="video/mp4">
                                        <source :src="secondaryPreviewPicture" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-success" @click="addSecondaryImage()">Añadir</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@push("scripts")

    @include("products.edit.script")

@endpush
