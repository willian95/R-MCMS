<script src="{{ url('ckeditor/ckeditor.js') }}"></script>
<script>
    
    const app = new Vue({
        el: '#dev-products',
        data(){
            return{
                imagesToUpload:[],
                workImages:JSON.parse('{!! $product->secondaryImages !!}'),
                secondaryPreviewPicture:"",
                secondaryPicture:"",
                categories:[],
                colors:[],
                sizes:[],
                brands:[],
                productFormatSizes:null,
                price:"",
                discountPrice:"",
                format:"",
                size:"",
                category:"{{ $product->category_id }}",
                brand:"{{ $product->brand_id }}",
                name:"{{ $product->name }}",
                description:"",
                action:"create",
                highlighted:false,
                productId:"{{ $product->id }}",
                pages:0,
                page:1,

                newCategory:"",
                imageCategoryPreview:"",
                imageCategoryProgress:"",
                pictureCategoryStatus:"",
                finalCategoryPictureName:"",


                newColor:"",
                newSize:"",
                categoryErrors:[],
                formatErrors:[],
                sizeErrors:[],
                errors:[],
                loading:false,
                stock:"",
                color:"",

                imagePreview:"{{ $product->image }}",
                imageHoverPreview:"{{ $product->image_hover }}",
                file:"",
                imageProgress:0,
                imageHoverProgress:0,
                pictureStatus:"listo",
                pictureHoverStatus:"listo",
                finalPictureName:"",
                finalHoverPictureName:"",
                productFormatModalAction:"create",
                productFormatId:"",

                secondaryPicture:"",
                secondaryPreviewPicture:"",
                secondaryFileType:"",
                fileName:""

                
            }
        },
        methods:{
            
            update(){

                if(this.productFormatSizes.length > 0){

                    var completeUploading = true

                    this.workImages.forEach((data) => {
                        if(data.status == 'subiendo'){
                            completeUploading = false
                        }
                    })

                    if(completeUploading && this.pictureStatus == "listo"){

                        this.workImages.forEach((data) => {
                            if(data.hasOwnProperty("id")){
                                this.imagesToUpload.push({id: data.id})
                            }else{
                                this.imagesToUpload.push({type:data.type, finalName:data.finalName})
                            }
                            
                        })

                        this.loading = true
                        axios.post("{{ route('products.update') }}", {
                            id:this.productId,
                            name:this.name, 
                            category: this.category, 
                            brand: this.brand,
                            image: this.finalPictureName, 
                            imageHover: this.finalHoverPictureName, 
                            productFormatSizes: this.productFormatSizes, 
                            description: CKEDITOR.instances.editor1.getData(), 
                            workImages: this.imagesToUpload, 
                            mainImageFileType: this.mainImageFileType}).then(res => {
                            this.loading = false
                            if(res.data.success == true){

                                swal({
                                    title: "Excelente!",
                                    text: "Producto actualizado!",
                                    icon: "success"
                                }).then(function() {
                                    window.location.href = "{{ route('products.list') }}";
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


                    }else{

                        swal({
                            text:"Aún hay contenido cargandose",
                            icon:"warning"
                        })

                    }
                
                }else{

                    swal({
                        title: "Oops!",
                        text: "Debe añadir presentaciones para continuar!",
                        icon: "warning"
                    })

                }

            },

            editProductFormat(productFormat, index){
                this.productFormatId = index
                this.productFormatModalAction = "edit"
                this.color = productFormat.color_id
                this.size = productFormat.size_id
                this.price = productFormat.price
                this.discountPrice = productFormat.discount_price
                this.stock = productFormat.stock

            },

            createProductFormat(){
                this.productFormatId = ""
                this.productFormatModalAction = "create"
                this.color = ""
                this.size = ""
                this.price = ""
                this.discountPrice = ""
                this.stock = ""

            },
            
            onMainImageChange(e){
                this.getImage(e, "main")
            },
            onHoverImageChange(e){
                this.getImage(e, "hover")
            },
            getImage(e, type){

                let picture = e.target.files[0];

                if(type == "main"){
                    this.imagePreview = URL.createObjectURL(picture);
                }else{
                    this.imageHoverPreview = URL.createObjectURL(picture);
                }
                
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0], type);

            },
            createImage(file, type) {
                this.file = file
                if(file['type'].split('/')[0] == "image"){
                    
                    
                    this.uploadMainImage(type)
                
                }else{

                    swal({
                        text:"Debe seleccionar un archivo de imagen",
                        icon:"error"
                    })

                }
                
            },
            uploadMainImage(type){
                
                if(type == "main"){

                    this.imageProgress = 0;
                }else{
                    this.imageHoverProgress = 0;
                }
                
                let formData = new FormData()
                formData.append("file", this.file)

                var _this = this
                if(type == "main"){
                    this.pictureStatus = "subiendo";
                }else{
                    
                    this.pictureHoverStatus = "subiendo";
                }

                var config = {
                    headers: { "X-Requested-With": "XMLHttpRequest" },
                    onUploadProgress: function(progressEvent) {
                        
                        var progressPercent = Math.round((progressEvent.loaded * 100.0) / progressEvent.total);
                        if(type == "main"){
                            _this.imageProgress = progressPercent
                        }else{
                            _this.imageHoverProgress = progressPercent
                        }
                        
                        
                        
                    }
                }

                axios.post(
                    "{{ url('/upload/picture') }}",
                    formData,
                    config                        
                ).then(res => {
                    
                    if(type == "main"){
                        this.pictureStatus = "listo";
                        this.finalPictureName = res.data.fileRoute
                    }else{
                        this.pictureHoverStatus = "listo";
                        this.finalHoverPictureName = res.data.fileRoute
                    }
                    

                }).catch(err => {
                    console.log(err)
                })

            },

            onImageCategoryChange(e){
                let newCategoryPicture = e.target.files[0];

                this.imageCategoryPreview = URL.createObjectURL(newCategoryPicture);
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createCategoryImage(files[0]);
            },
            createCategoryImage(file) {

                this.file = file
                if(file['type'].split('/')[0] == "image"){
                    
                    
                    this.uploadCategoryImage(type)
                
                }else{

                    swal({
                        text:"Debe seleccionar un archivo de imagen",
                        icon:"error"
                    })

                }

            },
            
            fetchCategories(){

                axios.get("{{ url('/categories/all') }}").then(res => {

                    this.categories = res.data

                })

            },

            fetchColors(){

                axios.get("{{ url('/colors/all') }}").then(res => {

                    this.colors = res.data

                })

            },

            fetchSizes(){

                axios.get("{{ url('/sizes/all') }}").then(res => {

                    this.sizes = res.data

                })

            },

            fetchBrands(){

                axios.get("{{ url('/brands/all') }}").then(res => {

                    this.brands = res.data

                })

            },

            addProductColor(){

                if(this.color != null && this.color != "" && this.price != null && this.price != "" && this.stock != null && this.stock != ""){
                    this.productFormatSizes.push({color: this.colors.find((data) => data.id == this.color), size: this.sizes.find((data) => data.id == this.size), price: this.price, stock: this.stock, discount_price: this.discountPrice})

                    this.color = ""
                    this.price = ""
                    this.stock = ""
                    this.size = ""
                    this.discountPrice = ""
                }else{
                    swal({
                        title: "Oppss!",
                        text: "Debes completar todos los campos",
                        icon: "error"
                    });
                }
                

            },

            updateProductColor(){

                if(this.color != null && this.color != "" && this.price != null && this.price != "" && this.stock != null && this.stock != ""){

                    this.productFormatSizes[this.productFormatId].color_id = this.color
                    this.productFormatSizes[this.productFormatId].size_id = this.size
                    this.productFormatSizes[this.productFormatId].price = this.price
                    this.productFormatSizes[this.productFormatId].stock = this.stock
                    this.productFormatSizes[this.productFormatId].discount_price = this.discountPrice

                    this.color = ""
                    this.price = ""
                    this.stock = ""
                    this.discountPrice = ""
                    this.size = ""
                }else{
                    swal({
                        title: "Oppss!",
                        text: "Debes completar todos los campos",
                        icon: "error"
                    });
                }


            },

            deleteProductFormatSize(index){

                this.productFormatSizes.splice(index, 1)

            },
            number_format(number, decimals, dec_point, thousands_point) {

                if (number == null || !isFinite(number)) {
                    throw new TypeError("number is not valid");
                }

                if (!decimals) {
                    var len = number.toString().split('.').length;
                    decimals = len > 1 ? len : 0;
                }

                if (!dec_point) {
                    dec_point = '.';
                }

                if (!thousands_point) {
                    thousands_point = ',';
                }

                number = parseFloat(number).toFixed(decimals);

                number = number.replace(".", dec_point);

                var splitNum = number.split(dec_point);
                splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
                number = splitNum.join(dec_point);

                return number;
            },
            isNumberDot(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                    evt.preventDefault();;
                } else {
                    return true;
                }
            },
            isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
                    evt.preventDefault();;
                } else {
                    return true;
                }
            },
            onSecondaryImageChange(e){
                this.secondaryPicture = e.target.files[0];

                this.secondaryPreviewPicture = URL.createObjectURL(this.secondaryPicture);
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createSecondaryImage(files[0]);
            },
            createSecondaryImage(file) {

                this.file = file

                if(file['type'].split('/')[0] == "image" || file['type'].split('/')[0] == "video"){
                    this.fileName = file['name']

                    this.secondaryFileType = file['type'].split('/')[0]

                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.secondaryPicture = e.target.result;
                    };
                    reader.readAsDataURL(file);

                    
                }else{
                    swal({
                        text:"Debes seleccionar un archivo de imagen",
                        icon:"error"
                    })
                }

            },
            uploadSecondaryImage(){

                let formData = new FormData()
                formData.append("file", this.file)
                formData.append('secondaryFileType', this.secondaryFileType)

                var _this = this
                var fileName = this.fileName
                
                var config = {
                    headers: { "X-Requested-With": "XMLHttpRequest" },
                    onUploadProgress: function(progressEvent) {
                        
                        var progressPercent = Math.round((progressEvent.loaded * 100.0) / progressEvent.total);
                        
                        
                        if(_this.workImages.length > 0){

                            _this.workImages.forEach((data,index) => {
                                
                                if(data.originalName == fileName){
                                _this.workImages[index].progress = progressPercent
                                }

                            })

                        }
                        
                    }
                }

                axios.post(
                    "{{ url('/upload/picture') }}",
                    formData,
                    config                        
                ).then(res => {
                    this.workImages.forEach((data, index) => {

                        if(data.hasOwnProperty("originalName")){
                            let returnedName = res.data.originalName.toLowerCase()

                            if(data.originalName.toLowerCase() == returnedName.toLowerCase()){
                                this.workImages[index].status = "listo";
                                this.workImages[index].finalName = res.data.fileRoute
                            }
                        }
                        

                    })

                }).catch(err => {
                    console.log(err)
                })

            },
            addSecondaryImage(){
        
                if(this.secondaryPicture != null){
                    this.uploadSecondaryImage()
                    this.workImages.push({image: this.secondaryPicture, status: "subiendo", originalName:this.fileName, finalName:"", progress:0, "type": this.secondaryFileType})

                    this.secondaryPicture = ""
                    this.secondaryPreviewPicture = ""

                }else{
                    swal({
                        title: "Oppss!",
                        text: "Debes añadir una imágen",
                        icon: "error"
                    });
                }


            },
            deleteWorkImage(index){

                this.workImages.splice(index, 1)

            },


        },
        mounted(){
            
            this.fetchCategories()
            this.fetchBrands()
            this.fetchColors()
            this.fetchSizes()
            CKEDITOR.replace( 'editor1' );
            this.productFormatSizes = JSON.parse(`{!! $product->productFormats !!}`)

        }

    })

</script>