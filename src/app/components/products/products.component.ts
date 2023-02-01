import { Component, OnInit } from '@angular/core';
import { Product } from 'src/app/product';
import { DataService } from 'src/app/service/data.service';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { FormBuilder,FormGroup,Validators} from '@angular/forms';
import { Post } from 'src/app/models/post.model';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit {
products:any;
product=new Product;
post=new Post;
files:any;
submitted=false;
form:any
data:any
image:any 
imageDirectoryPath:any='assets/dist/img/';
  constructor(private dataService:DataService,private route:Router,private toastr:ToastrService,private formBuilder:FormBuilder) { }

  createForm(){
    this.form=this.formBuilder.group({
      image:[null,Validators.required],
      name:[''],
      category:[''],
      description:[''],
      brand:[''],
      price:[''],
    })
  }
  ngOnInit(): void {
    this.getProductData();
    this.createForm();
  }

  getProductData(){
      console.log('liste des produits');
      this.dataService.getData().subscribe(res =>{
        console.log(res);
        this.products = res;
      })
  }

  deleteData(id:any){
    this.dataService.deletetData(id).subscribe(res =>{
      this.getProductData();
    })
  }
  get f(){
    return this.form.controls;
  }
  uploadImage(event:any){
    this.files=event.target.files[0];
    console.log(this.image);
  }
  onSubmit(){
   this.submitted=true;
   if(this.form.invalid){
    return;
   }
   const formData=new FormData();
   formData.append("image",this.files,this.files.name);
   formData.append("name",this.product.name);
   formData.append("category",this.product.category);
   formData.append("description",this.product.description);
   formData.append("brand",this.product.brand);
   formData.append("price",this.product.price);
   console.log(this.product)
   this.dataService.uploadData(formData).subscribe(res=>{
    this.data=res;
    console.log(this.data);
    if(this.data.status=true){
      this.toastr.success(JSON.stringify(this.data.message),'',{
        timeOut:2000,
        progressBar:true
      });
    }
    else{
      this.toastr.error(JSON.stringify(this.data.message),'',{
        timeOut:2000,
        progressBar:true
      })
    }
    this.submitted=false;
    this.form.get('image').reset();
    this.form.get('name').reset();
    this.form.get('category').reset();
    this.form.get('description').reset();
    this.form.get('brand').reset();
    this.form.get('price').reset();
    this.ngOnInit();
  });
  }
}
