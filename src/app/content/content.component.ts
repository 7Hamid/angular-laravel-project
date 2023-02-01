import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { Product } from '../product';
import { DataService } from '../service/data.service';

@Component({
  selector: 'app-content',
  templateUrl: './content.component.html',
  styleUrls: ['./content.component.css']
})
export class ContentComponent implements OnInit{
  path:any="assets/dist/img/"
  product=new Product;
  products:any;
  constructor(private dataService:DataService,
    private http :HttpClient){

  }
  ngOnInit(): void {
    this.getProductData();
    
  }
  getProductData(){
    console.log('liste des produits');
    this.dataService.getData().subscribe(res =>{
      console.log(res);
      this.products = res;
      console.log(this.products);
      
    })
  }
  bookdownload(id:any){
    this.dataService.downloadbook(id).subscribe(response=>{
    });
}
}
