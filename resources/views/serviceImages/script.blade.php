
<script>

var app = new Vue({
    el: '#dev-products',
    data(){
        return{
            pictureStatus:"",
            imageProgress:"",
            finalPictureName:"",
            imagePreview:"{{ App\Models\ServiceImage::first() ? App\Models\ServiceImage::first()->image1 : '' }}",
            file:"",
            picture:"",
            fileName:"",
            mainImageFileType:"{{ App\Models\ServiceImage::first() ? App\Models\ServiceImage::first()->type1 : '' }}",

            pictureStatus2:"",
            imageProgress2:"",
            finalPictureName2:"",
            imagePreview2:"{{ App\Models\ServiceImage::first() ? App\Models\ServiceImage::first()->image2 : '' }}",
            file2:"",
            picture2:"",
            fileName2:"",
            mainImageFileType2:"{{ App\Models\ServiceImage::first() ? App\Models\ServiceImage::first()->type2 : '' }}",

            pictureStatus3:"",
            imageProgress3:"",
            finalPictureName3:"",
            imagePreview3:"{{ App\Models\ServiceImage::first() ? App\Models\ServiceImage::first()->image3 : '' }}",
            file3:"",
            picture3:"",
            fileName3:"",
            mainImageFileType3:"{{ App\Models\ServiceImage::first() ?  App\Models\ServiceImage::first()->type3 : '' }}",

            errors:[],
            loading:false,
            url:""

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

            
            if(this.mainImageFileType == "image" || this.mainImageFileType == 'video'){
                
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.picture = e.target.result;
                };
                reader.readAsDataURL(file);
                this.uploadMainImage()
            }else{

                swal({
                    text:"Formato no permitido",
                    "icon": "error"
                })

            }

            
        },

        uploadMainImage(){

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

                }).catch(err => {
                    this.loading = false
                    console.log(err)
                })

            }

        },


        onImageChange2(e){
            this.picture2 = e.target.files[0];

            this.imagePreview2 = URL.createObjectURL(this.picture2);
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.view_image = false
            this.createImage2(files[0]);
        },
        createImage2(file) {
            this.file2 = file
            this.mainImageFileType2 = file['type'].split('/')[0]

            
            if(this.mainImageFileType2 == "image" || this.mainImageFileType2 == 'video'){
                
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.picture2 = e.target.result;
                };
                reader.readAsDataURL(file);
                this.uploadMainImage2()
            }else{

                swal({
                    text:"Formato no permitido",
                    "icon": "error"
                })

            }

            
        },

        uploadMainImage2(){

            if(this.picture2){
                
                this.loading = true
                this.imageProgress2 = 0;
                let formData = new FormData()
                formData.append("file", this.file2)

                var _this = this
                var fileName = this.fileName
                this.pictureStatus2 = "subiendo";

                var config = {
                    headers: { "X-Requested-With": "XMLHttpRequest" },
                    onUploadProgress: function(progressEvent) {
                        
                        var progressPercent = Math.round((progressEvent.loaded * 100.0) / progressEvent.total);
                    
                        _this.imageProgress2 = progressPercent
                        
                    }
                }

                axios.post(
                    "{{ url('/upload/picture') }}",
                    formData,
                    config                        
                ).then(res => {

                    this.pictureStatus2 = "listo";
                    this.finalPictureName2 = res.data.fileRoute
                    this.loading = false

                }).catch(err => {
                    this.loading = false
                    console.log(err)
                })

            }

        },


        onImageChange3(e){
            this.picture3 = e.target.files[0];

            this.imagePreview3 = URL.createObjectURL(this.picture3);
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.view_image = false
            this.createImage3(files[0]);
        },
        createImage3(file) {
            this.file3 = file
            this.mainImageFileType3 = file['type'].split('/')[0]

            
            if(this.mainImageFileType3 == "image" || this.mainImageFileType3 == 'video'){
                
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.picture3 = e.target.result;
                };
                reader.readAsDataURL(file);
                this.uploadMainImage3()
            }else{

                swal({
                    text:"Formato no permitido",
                    "icon": "error"
                })

            }

            
        },

        uploadMainImage3(){

            if(this.picture3){
                
                this.loading = true
                this.imageProgress3 = 0;
                let formData = new FormData()
                formData.append("file", this.file3)

                var _this = this
                var fileName = this.fileName3
                this.pictureStatus = "subiendo";

                var config = {
                    headers: { "X-Requested-With": "XMLHttpRequest" },
                    onUploadProgress: function(progressEvent) {
                        
                        var progressPercent = Math.round((progressEvent.loaded * 100.0) / progressEvent.total);
                    
                        _this.imageProgress2 = progressPercent
                        
                    }
                }

                axios.post(
                    "{{ url('/upload/picture') }}",
                    formData,
                    config                        
                ).then(res => {

                    this.pictureStatus3 = "listo";
                    this.finalPictureName3 = res.data.fileRoute
                    this.loading = false

                }).catch(err => {
                    this.loading = false
                    console.log(err)
                })

            }

        },

        store(){

            this.loading = true
            axios.post("{{ route('service-images.store') }}", {
                image1: this.finalPictureName,
                type1:this.mainImageFileType,
                image2: this.finalPictureName2,
                type2:this.mainImageFileType2,
                image3: this.finalPictureName3,
                type3:this.mainImageFileType3,
            }).then(res => {
                this.loading = false
                if(res.data.success == true){

                    swal({
                        title: "Excelente!",
                        text: res.data.msg,
                        icon: "success"
                    })

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

        }

    }

})

</script>