<script>

    var app = new Vue({
        el: '#dev-products',
        data(){
            return{
                dog_category:JSON.parse("{{ $category->dog_category }}"),
                cat_category:JSON.parse("{{ $category->cat_category }}"),
                pictureStatus:"",
                imageProgress:"",
                finalPictureName:"",
                imagePreview:"{{ $category->image }}",

                selectedCategory:"0",
                title:"{{ $category->name }}",
                errors:[],
                id:"{{ $category->id }}",
                loading:false

            }
        },
        methods:{

            onImageChange(e){
                this.picture = e.target.files[0];

                this.imagePreview = URL.createObjectURL(this.picture);
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.view_image = false
                this.createImage(files[0]);
            },
            createImage(file) {
                this.file = file
                this.mainImageFileType = file['type'].split('/')[0]

                
                if(this.mainImageFileType == "image"){
                    
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.picture = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }else{

                    swal({
                        text:"Formato no permitido",
                        "icon": "error"
                    })

                }

                
            },

            uploadMainImage(){

                if(this.title == ""){
                    swal({
                        text:"Titulo es requerido",
                        "icon": "error"
                    })

                    return
                }

                if(this.picture){
                    
                    this.loading = true
                    this.imageProgress = 0;
                    let formData = new FormData()
                    formData.append("file", this.file)
                    formData.append("upload_preset", this.cloudinaryPreset)

                    var _this = this
                    var fileName = this.fileName
                    this.pictureStatus = "subiendo";

                    var config = {
                        headers: { "X-Requested-With": "XMLHttpRequest" },
                        onUploadProgress: function(progressEvent) {
                            
                            var progressPercent = Math.round((progressEvent.loaded * 100.0) / progressEvent.total);
                        
                            _this.imageProgress = progressPercent
                            
                        }
                    }

                    axios.post(
                        "{{ url('/upload/picture') }}",
                        formData,
                        config                        
                    ).then(res => {
                        
                        this.pictureStatus = "listo";
                        this.finalPictureName = res.data.fileRoute
                        this.loading = false
                        this.update()

                    }).catch(err => {
                        this.loading = false
                        console.log(err)
                    })

                }else{

                    this.update()
                    /*swal({
                        text:"No hay imagen para subir",
                        "icon": "error"
                    })*/


                }

            },

            update(){

                if(this.dog_category == 0 && this.cat_category == 0){
                    swal({
                        text: "Debes elegir si esta categor??a es para caninos o felinos",
                        icon: "warning"
                    })

                    return
                }

                this.loading = true
                axios.post("{{ route('categories.update') }}", {
                    dog_category: this.dog_category,
                    cat_category: this.cat_category,
                    name:this.title,
                    image: "imagen.jpg",
                    id:this.id
                }).then(res => {
                    this.loading = false
                    if(res.data.success == true){

                        swal({
                            title: "Excelente!",
                            text: res.data.msg,
                            icon: "success"
                        }).then(function() {
                            window.location.href = "{{ route('categories.list') }}";
                        });


                    }else{

                        alert(res.data.msg)
                    }

                }).catch(err => {

                    this.loading = false
                    this.errors = err.response.data.errors

                    swal({
                        text: "Hay campos que debes verificar!",
                        icon: "warning"
                    })

                })

            },
        }

    })

</script>