# wsdl2phpgenerator-cli

Simple Console Client to generate php classes from a wsdl file based on Wsdl2PhpGenerator Library

### Get the package using composer

```bash
composer require venture-oak-labs/wsdl2php-generator-cli
```

Read the full documentation at https://github.com/wsdl2phpgenerator/wsdl2phpgenerator.

### Options exposed:

- inputFile https://github.com/wsdl2phpgenerator/wsdl2phpgenerator#inputfile
- outputDir https://github.com/wsdl2phpgenerator/wsdl2phpgenerator#outputdir
- namespaceName https://github.com/wsdl2phpgenerator/wsdl2phpgenerator#namespacename
- operationNames https://github.com/wsdl2phpgenerator/wsdl2phpgenerator#operationnames
- soapClientClass https://github.com/wsdl2phpgenerator/wsdl2phpgenerator#soapclientclass
- soapClientOptions https://github.com/wsdl2phpgenerator/wsdl2phpgenerator#soapclientoptions

### Examples

```bash
php application.php wsdl2php-generator --help // view the options

php application.php wsdl2php-generator http://urltowsdl?wsdl /var/www/demo/wsdl --namespaceName AcmeDemoBundle --operationNames doLoginActiveDirectory,doLoginAcme --soapClientOptions login,username --soapClientOptions password,secret
```

 

