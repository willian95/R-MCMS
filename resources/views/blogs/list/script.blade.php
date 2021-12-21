<script>

    var app = new Vue({
        el: '#dev-list',
        data(){
            return{

                blogs:[],
                links:[],
                currentPage:"",
                totalPages:"",
                linkClass:"page-link",
                activeLinkClass:"page-link active-link bg-main",


            }
        },
        methods:{

            async fetch(link = "{{ route('blogs.fetch') }}"){

                let res = await axios.get("{{ route('blogs.fetch') }}")
                this.blogs = res.data.data
                this.links = res.data.links
                this.currentPage = res.data.current_page
                this.totalPages = res.data.last_page

            },
            erase(id){
                
                swal({
                    title: "¿Estás seguro?",
                    text: "Eliminarás este blog!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.loading = true
                        axios.post("{{ route('blogs.delete') }}", {id: id}).then(res => {
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


        },
        mounted(){

           this.fetch()

        }

    })

</script>