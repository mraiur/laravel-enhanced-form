# laravel-enhanced-form
Extend Laravel forms to add convinient access and helps.
The package is extending the Laravels Html/From package to add additional functionality.


## Example:

```
{!! Form::ariaSelect('test', [
    ['id' => 1, 'title' => 'title->a', 'role' => 'user'],
    ['id' => 2, 'title' => 'title->b', 'role' => 'admin']
], null, ['displayValue'=>'title', 'submitValue' => 'id']) !!}

```
Output:
```
<select displayvalue="title" submitvalue="id" name="test">
    <option value="1" role="user">title-&gt;a</option>
    <option value="2" role="admin">title-&gt;b</option></select>
```

##  Setup
After install add to your app.php in providers array:

```
'Illuminate\Html\HtmlServiceProvider',
"Mraiur\EnhancedForm\FormServiceProvider"
```

Add to aliases array:

```
'Form'=> 'Illuminate\Html\FormFacade', 
'HTML'=> 'Illuminate\Html\HtmlFacade'
```
