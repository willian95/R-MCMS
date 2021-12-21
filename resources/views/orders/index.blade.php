@extends("layouts.main")

@section("content")
    
    <div id="dev-category">
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content" v-cloak>
            <div class="d-flex flex-column-fluid">

                <div class="container">
                
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap py-3">
                            <div class="card-title">
                                <h3 class="card-label">Ventas
                            </div>
                            <div class="card-toolbar">
                                
                            <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @click="toggleMenu()">
                                        <span class="svg-icon svg-icon-md">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                                    <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                        Exportar
                                    </button>
                                    <!--begin::Dropdown Menu-->
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" id="menu">
                                        <!--begin::Navigation-->
                                        <ul class="navi flex-column navi-hover py-2">
                                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Elige una opción:</li>
                                            
                                            <li class="navi-item">
                                                <a href="{{ url('/admin/shopping/excel') }}" target="_blank" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="la la-file-excel-o"></i>
                                                    </span>
                                                    <span class="navi-text">Excel</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!--end::Navigation-->
                                    </div>
                                    <!--end::Dropdown Menu-->
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-checkable" id="kt_datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cliente</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(shopping, index) in shoppings">
                                        <th>@{{ shopping.order_id }}</th>
                                        <td v-if="shopping.user">@{{ shopping.user.name }}</td>
                                        <td v-if="shopping.guest">@{{ shopping.guest.name }}</td>
                                        <td style="text-transform: capitalize;">@{{ shopping.status }}</td>
                                        <td>$ @{{ parseInt(shopping.total).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</td>
                                        <td>@{{ shopping.created_at.toString().substring(0, 10) }}</td>
                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#shoppingModal" @click="show(shopping)"><i class="far fa-eye"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="kt_datatable_info" role="status" aria-live="polite">Mostrando página @{{ page }} de @{{ pages }}</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_full_numbers" id="kt_datatable_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled" id="kt_datatable_previous" v-if="page > 1">
                                                <a href="#" aria-controls="kt_datatable" data-dt-idx="1" tabindex="0" class="page-link">
                                                    <i class="ki ki-arrow-back"></i>
                                                </a>
                                            </li>
                                            <li class="paginate_button page-item active" v-for="index in pages">
                                                <a href="#" aria-controls="kt_datatable" tabindex="0" class="page-link":key="index" @click="fetch(index)" >@{{ index }}</a>
                                            </li>
                                            
                                            <li class="paginate_button page-item next" id="kt_datatable_next" v-if="page < pages" href="#">
                                                <a href="#" aria-controls="kt_datatable" data-dt-idx="7" tabindex="0" class="page-link" @click="fetch(page + 6)">
                                                    <i class="ki ki-arrow-next"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--end: Datatable-->
                        </div>
                    </div>

                </div>

            </div>

            <!-- Modal-->
            <div class="modal fade" id="shoppingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Información</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body" v-if="shopping != ''">
                            <div class="row">
                                <div class="col-md-6">
                                    <label><strong>Cliente</strong></label>
                                    <p v-if="shopping.user">@{{ shopping.user.name }}</p>
                                    <p v-if="shopping.guest">@{{ shopping.guest.name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label><strong>Email</strong></label>
                                    <p v-if="shopping.user">@{{ shopping.user.email }}</p>
                                    <p v-if="shopping.guest">@{{ shopping.guest.email }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label><strong>Costo productos</strong></label>
                                    <p>$ @{{ parseInt(shopping.total_products).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label><strong>Costo envío</strong></label>
                                    <p>$ @{{ parseInt(shopping.shipping_cost).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label><strong>Total</strong></label>
                                    <p>$ @{{ parseInt(shopping.total).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label><strong>Tracking</strong></label>
                                    <p>
                                    <a :href="shopping.tracking_url">@{{ shopping.tracking }}</a>
                                    </p>
                                </div>
                                <!--<div class="col-md-6">
                                    <label>Status tracing</label>
                                    <p>@{{ shopping.status_shipping }}</p>
                                </div>-->
                                <div class="col-md-6">
                                    <label><strong>Dirección</strong></label>
                                    <p>@{{ shopping.address }}</p>
                                </div>
                                <div class="col-md-12">
                                    <h3 class="text-center">Productos</h3>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered table-checkable">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Precio</th>
                                                <th>Tipo</th>
                                                <th>Tamaño</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(shoppingPurchase, index) in shopping.product_purchases">
                                                <td>@{{ shoppingPurchase.product_type_size.product.brand.name }} - @{{ shoppingPurchase.product_type_size.product.name }}</td>
                                                <td>$ @{{ parseInt(shoppingPurchase.price).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</td>
                                                <td>@{{ shoppingPurchase.product_type_size.type.name }}</td>
                                                <td>@{{ shoppingPurchase.product_type_size.size.name }} OZ - @{{ shoppingPurchase.product_type_size.size.ml }} ML</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

@endsection

@push("scripts")

    @include("orders.script")

@endpush