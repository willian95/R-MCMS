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
                showMenu:false


            }
        },
        methods:{

            async fetch(link = "{{ route('products.fetch') }}"){

                let res = await axios.get("{{ route('products.fetch') }}")
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