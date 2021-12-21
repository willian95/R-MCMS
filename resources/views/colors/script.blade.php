<script>
        
    const app = new Vue({
        el: '#dev-list',
        data(){
            return{
                modalTitle:"Nuevo color",
                color:"",
                hex:"",
                colorId:"",
                action:"create",
                colors:[],
                errors:[],
                pages:0,
                page:1,
                showMenu:false,
                loading:false,
            }
        },
        methods:{
            
            create(){
                this.modalTitle = "Crear color"
                this.action = "create"
                this.color = ""
                this.colorId = ""
                this.hex = ""

            },
            store(){

                this.loading = true
                axios.post("{{ route('colors.store') }}", {color: this.color, hex: this.hex})
                .then(res => {
                    this.loading = false
                    if(res.data.success == true){

                        swal({
                            title: "Perfecto!",
                            text: res.data.msg,
                            icon: "success"
                        });
                        this.color = ""
                        this.hex = ""
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
                axios.post("{{ route('colors.update') }}", {id: this.colorId, color: this.color, hex: this.hex})
                .then(res => {
                    this.loading = false
                    if(res.data.success == true){

                        swal({
                            title: "Excelente!",
                            text: res.data.msg,
                            icon: "success"
                        });
                        this.color = ""
                        this.hex = ""
                        this.colorId = ""
 
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
            edit(color){
                this.modalTitle = "Editar color"
                this.action = "edit"
                this.color = color.color
                this.hex = color.hex
                this.colorId = color.id

            },
            fetch(){

                axios.get("{{ route('colors.fetch') }}")
                .then(res => {

                    this.colors = res.data

                })

            },
            erase(id){
                
                swal({
                    title: "¿Estás seguro?",
                    text: "Eliminarás este color!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.loading = true
                        axios.post("{{ route('colors.delete') }}", {id: id}).then(res => {
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