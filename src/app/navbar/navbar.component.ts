import { Component } from '@angular/core';
import { Router,NavigationExtras } from '@angular/router';
import { DataService } from '../service/data.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent {
  data:any
  constructor(private dataservice:DataService,private router:Router){

  }
  ngOnInit(): void {
    
  }
  getProductSearch(name:any){
    const keyword=name.target.value;
    const search=this.dataservice.getSearchProductName(keyword).then(response=>{
      this.data=response;
      console.log(this.data);
      
    });
  }
  getDetailPage(result:any){
    console.log(result);
    const navigationExtras:NavigationExtras={
      queryParams:{
        result:JSON.stringify(result)
      }
    }
    this.router.navigate(['search-detail'],navigationExtras)
  }
}
