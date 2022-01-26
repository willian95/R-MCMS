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
                        <h3 class="card-label">Imágenes de servicios
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Imágen o video clínica (jpg,png, mp4 | Dimensiones recomendadas: 1024x900px | max: 8 Mb )</label>
                                <input type="file" class="form-control" ref="file" @change="onImageChange" accept="image/* | video/*" style="overflow: hidden;">

                                <img id="blah" :src="imagePreview" class="full-image" style="margin-top: 10px; width: 40%" v-if="imagePreview != '' && mainImageFileType == 'image'">

                                <video class="w-100" controls v-if="imagePreview != '' && mainImageFileType == 'video'">
                                    <source :src="imagePreview" type="video/mp4">
                                    <source :src="imagePreview" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>

                                <div v-if="pictureStatus == 'subiendo'" class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="{'width': `${imageProgress}%`}">
                                    @{{ imageProgress }}%
                                </div>

                                <p v-if="pictureStatus == 'subiendo' && imageProgress < 100">Subiendo</p>
                                <p v-if="pictureStatus == 'subiendo' && imageProgress == 100">Espere un momento</p>
                                <p v-if="pictureStatus == 'listo' && imageProgress == 100">Imágen lista</p>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Imágen o video peluquería (jpg,png, mp4 | Dimensiones recomendadas: 1024x900px | max: 8 Mb )</label>
                                <input type="file" class="form-control" ref="file" @change="onImageChange2" accept="image/* | video/*" style="overflow: hidden;">

                                <img id="blah" :src="imagePreview2" class="full-image" style="margin-top: 10px; width: 40%" v-if="imagePreview2 != '' && mainImageFileType2 == 'image'">

                                <video class="w-100" controls v-if="imagePreview2 != '' && mainImageFileType2 == 'video'">
                                    <source :src="imagePreview2" type="video/mp4">
                                    <source :src="imagePreview2" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>

                                <div v-if="pictureStatus2 == 'subiendo'" class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="{'width': `${imageProgress2}%`}">
                                    @{{ imageProgress2 }}%
                                </div>

                                <p v-if="pictureStatus2 == 'subiendo' && imageProgress2 < 100">Subiendo</p>
                                <p v-if="pictureStatus2 == 'subiendo' && imageProgress2 == 100">Espere un momento</p>
                                <p v-if="pictureStatus2 == 'listo' && imageProgress2 == 100">Imágen lista</p>


                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Imágen o video hotel (jpg,png, mp4 | Dimensiones recomendadas: 1024x900px | max: 8 Mb )</label>
                                <input type="file" class="form-control" ref="file" @change="onImageChange3" accept="image/* | video/*" style="overflow: hidden;">

                                <img id="blah" :src="imagePreview3" class="full-image" style="margin-top: 10px; width: 40%" v-if="imagePreview3 != '' && mainImageFileType3 == 'image'">

                                <video class="w-100" controls v-if="imagePreview3 != '' && mainImageFileType3 == 'video'">
                                    <source :src="imagePreview3" type="video/mp4">
                                    <source :src="imagePreview3" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>

                                <div v-if="pictureStatus3 == 'subiendo'" class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="{'width': `${imageProgress3}%`}">
                                    @{{ imageProgress3 }}%
                                </div>

                                <p v-if="pictureStatus3 == 'subiendo' && imageProgress3 < 100">Subiendo</p>
                                <p v-if="pictureStatus3 == 'subiendo' && imageProgress3 == 100">Espere un momento</p>
                                <p v-if="pictureStatus3 == 'listo' && imageProgress3 == 100">Imágen lista</p>


                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <p class="text-center">
                                <button class="btn btn-success" @click="store()">Actualizar</button>
                            </p>
                        </div>
                    </div>


                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->


    </div>

@endsection

@push("scripts")

    @include("serviceImages.script")

@endpush
