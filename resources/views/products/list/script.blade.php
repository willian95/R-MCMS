<script>

    var app = new Vue({
        el: '#dev-list',
        data(){
            return{

                products:[],
                links:[],
                currentPage:"",
                totalPages:"",
                linkClass:"page-link",
                activeLinkClass:"page-link active-link bg-main",
                showMenu:false,
                search:""


            }
        },
        methods:{

            async fetch(link = "{{ route('products.fetch') }}"){

                if(this.search != ""){
                    link += "&search="+this.search
                }

                let res = await axios.get(link)
                this.products = res.data.data
                this.links = res.data.links
                this.currentPage = res.data.current_page
                this.totalPages = res.data.last_page

            },
            async searchProduct(){

                let res = await axios.get("{{ url('products/search-products') }}"+"?search="+this.search)
                this.products = res.data.data
                this.links = res.data.links
                this.currentPage = res.data.current_page
                this.totalPages = res.data.last_page

            },
            erase(id){
                
                swal({
                    title: "¿Estás seguro?",
                    text: "Eliminarás este producto!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.loading = true
                        axios.post("{{ route('products.delete') }}", {id: id}).then(res => {
                            this.loading = false
                            if(res.data.success == true){
                                swal({
                                    title: "Genial!",
                                    text: res.data.msg,
                                    icon: "success"
                                });
                                this.fetch()
                            }else{

                                swal({
                                    title: "Lo sentimos!",
                                    text: res.data.msg,
                                    icon: "error"
                                });

                            }

                        }).catch(err => {
                            this.loading = false
                            $.each(err.response.data.errors, function(key, value){
                                alert(value)
                            });
                        })

                    }
                });

            },
            destroy(id){
                
                swal({
                    title: "¿Estás seguro?",
                    text: "Eliminarás este producto para siempre!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.loading = true
                        axios.post("{{ route('products.destroy') }}", {id: id}).then(res => {
                            this.loading = false
                            if(res.data.success == true){
                                swal({
                                    title: "Genial!",
                                    text: res.data.msg,
                                    icon: "success"
                                });
                                this.fetch()
                            }else{

                                swal({
                                    title: "Lo sentimos!",
                                    text: res.data.msg,
                                    icon: "error"
                                });

                            }

                        }).catch(err => {
                            this.loading = false
                            $.each(err.response.data.errors, function(key, value){
                                alert(value)
                            });
                        })

                    }
                });

            },
            restore(id){

                axios.post("{{ route('products.restore') }}", {id: id}).then(res => {
                    this.loading = false
                    if(res.data.success == true){
                        swal({
                            title: "Genial!",
                            text: res.data.msg,
                            icon: "success"
                        });
                        this.fetch()
                    }else{

                        swal({
                            title: "Lo sentimos!",
                            text: res.data.msg,
                            icon: "error"
                        });

                    }

                })

            },
            toggleMenu(){

                if(this.showMenu == false){
                    $("#menu").addClass("show")
                    this.showMenu = true
                }else{
                    $("#menu").removeClass("show")
                    this.showMenu = false
                }

            }


        },
        mounted(){

           this.fetch()

        }

    })

</script>