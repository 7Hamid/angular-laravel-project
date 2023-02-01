import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-home-search',
  templateUrl: './home-search.component.html',
  styleUrls: ['./home-search.component.css']
})
export class HomeSearchComponent implements OnInit{
  itemDetail:any=[];
  constructor(private route:ActivatedRoute){
    this.route.queryParams.subscribe((response)=>{
      const paramsData=JSON.parse(response['result']);
      this.itemDetail=paramsData;
      
    });
  }
  ngOnInit(): void {
    
  }
}
