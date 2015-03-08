# laravel-enhanced-form
Extend Laravel forms to add convinient access and helps.
The package is extending the Laravels Html/From package to add additional functionality.


### Example select :

```
{!! Form::ariaSelect('test', [
    ['id' => 1, 'title' => 'title->a', 'role' => 'user'],
    ['id' => 2, 'title' => 'title->b', 'role' => 'admin']
], null, ['displayValue'=>'title', 'submitValue' => 'id', 'aria' => 'role']) !!}
```




Output:

```
<select aria-displayvalue="title" aria-submitvalue="id" name="test">
    <option value="1" aria-role="user">title-&gt;a</option>
    <option value="2" aria-role="admin">title-&gt;b</option></select>
```

### New component using hidden input by default for easy form data access via js for example.

```
{!! Form::aria(['aria' => 'role,myid', 'name' => 'testName'], [
    'value' => 'TEST',
    'role' => "admin",
    'myid' => 1
]) !!}
```

Output:

```
<input name="testName" type="hidden" value="TEST" data-role="admin" data-myid="1">
```

Setting the aria value to a comma separated list will add the matching Model attributes.

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
