<script>

    var app = new Vue({
        el: '#dev-list',
        data(){
            return{

                brands:[],
                links:[],
                currentPage:"",
                totalPages:"",
                linkClass:"page-link",
                activeLinkClass:"page-link active-link bg-main",
                search:"",
                showMenu:false

            }
        },
        methods:{

            async fetch(link = "{{ route('brands.fetch') }}"){

                let res = await axios.get(link)
                this.brands = res.data.data
                this.links = res.data.links
                this.currentPage = res.data.current_page
                this.totalPages = res.data.last_page

            },
            erase(id){
                
                swal({
                    title: "¿Estás seguro?",
                    text: "Eliminarás esta marca!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.loading = true
                        axios.post("{{ route('brands.delete') }}", {id: id}).then(res => {
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

            },
            async searchBrand(){

                let res = await axios.get("{{ url('brands/search-brands') }}"+"?search="+this.search)
                this.brands = res.data.data
                this.links = res.data.links
                this.currentPage = res.data.current_page
                this.totalPages = res.data.last_page

            },


        },
        mounted(){

           this.fetch()

        }

    })

</script>