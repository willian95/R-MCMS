<script>
        
    const app = new Vue({
        el: '#dev-list',
        data(){
            return{
                modalTitle:"Nueva talla",
                name:"",
                sizeId:"",
                action:"create",
                sizes:[],
                errors:[],
                pages:0,
                page:1,
                showMenu:false,
                loading:false,
            }
        },
        methods:{
            
            create(){
                this.modalTitle = "Crear talla"
                this.action = "create"
                this.name = ""
                this.sizeId = ""

            },
            store(){

                this.loading = true
                axios.post("{{ route('sizes.store') }}", {size: this.name})
                .then(res => {
                    this.loading = false
                    if(res.data.success == true){

                        swal({
                            title: "Perfecto!",
                            text: res.data.msg,
                            icon: "success"
                        });
                        this.name = ""
                        this.fetch()

                        $('#categoryModal').modal('hide')
                        $('.modal-backdrop').remove()
                    }else{

                        swal({
                            title: "Lo sentimos!",
                            text: res.data.msg,
                            icon: "error"
                        });

                    }

                })
                .catch(err => {
                    this.loading = false
                    this.errors = err.response.data.errors
                })

            },
            update(){

                this.loading = true
                axios.post("{{ route('sizes.update') }}", {id: this.sizeId, size: this.name})
                .then(res => {
                    this.loading = false
                    if(res.data.success == true){

                        swal({
                            title: "Excelente!",
                            text: res.data.msg,
                            icon: "success"
                        });
                        this.size = ""
                        this.sizeId = ""
 
                        $('#categoryModal').modal('hide')
                        $('.modal-backdrop').remove()
                        this.fetch()
                        
                    }else{

                        swal({
                            title: "Lo sentimos!",
                            text: res.data.msg,
                            icon: "error"
                        });

                    }

                })
                .catch(err => {
                    this.loading = false
                    this.errors = err.response.data.errors
                })

            },
            edit(size){
                this.modalTitle = "Editar talla"
                this.action = "edit"
                this.name = size.size
                this.sizeId = size.id

            },
            fetch(){

                axios.get("{{ route('sizes.fetch') }}")
                .then(res => {

                    this.sizes = res.data

                })

            },
            erase(id){
                
                swal({
                    title: "¿Estás seguro?",
                    text: "Eliminarás esta talla!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.loading = true
                        axios.post("{{ route('sizes.delete') }}", {id: id}).then(res => {
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