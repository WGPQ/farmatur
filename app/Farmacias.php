<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmacias extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_division', 'nomfarmacia', 'telefono','direccion', 'latitude', 'longitude', 'jerarquia'
     ];
    public function Ciudad(){
        
        return $this->belongsTo('App\Divpolitica','id_division');

    }
     

    
     /**
      * The accessors to append to the model's array form.
      *
      * @var array
      */
     public $appends = [
         'coordinate', 'map_popup_content',
     ];
 
     /**
      * Get outlet name_link attribute.
      *
      * @return string
      */
     public function getNameLinkAttribute()
     {
         $title = __('app.show_detail_title', [
             'name' => $this->name, 'type' => __('farm.farm'),
         ]);
         $link = '<a href="'.route('farmacia.show', $this).'"';
         $link .= ' title="'.$title.'">';
         $link .= $this->name;
         $link .= '</a>';
 
         return $link;
     }
 
     /**
      * Outlet belongs to User model relation.
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function creator()
     {
         return $this->belongsTo(User::class);
     }
 
     /**
      * Get outlet coordinate attribute.
      *
      * @return string|null
      */
     public function getCoordinateAttribute()
     {
         if ($this->latitude && $this->longitude) {
 
             return $this->latitude.', '.$this->longitude;
         }
     }
 
     /**
      * Get outlet map_popup_content attribute.
      *
      * @return string
      */
     
     public function getMapPopupContentAttribute()
     {
         $mapPopupContent = '*****************FARMATURN*************';
         $mapPopupContent .= '<div class="my-2"><strong>'.__('Farmacia').':</strong><br>'.$this->nomfarmacia.'</div>';
         $mapPopupContent .= '<div class="my-2"><strong>'.__('Telefono').':</strong><br>'.$this->telefono.'</div>';
         $mapPopupContent .= '<div class="my-2"><strong>'.__('Direccion').':</strong><br>'.$this->direccion.'</div>';
        // $mapPopupContent .= '<div class="my-2"><strong>'.__('Coordenadas').':</strong><br>'.$this->coordinate.'</div>';
 
         return $mapPopupContent;
     }
}
