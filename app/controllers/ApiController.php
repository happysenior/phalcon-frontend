<?php

use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;


class ApiController extends ControllerBase
{

    public $curl;
    public $curlOptions;

    public function initialize()
    {
        $this->view->disable();
        $this->curl = curl_init();
        $authUser = $this->request->getServer('PHP_AUTH_USER');
        $authPw = $this->request->getServer('PHP_AUTH_PW');
        $authorizationHeader = $this->request->getHeader('Authorization');
        $headers = $this->request->getHeaders();
        //var_dump($headers);
        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HEADER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            //CURLOPT_HTTP_CONTENT_DECODING => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        ];
        if ($authUser && $authPw) {
            $options[CURLOPT_HTTPHEADER] = ["Authorization: Basic " . base64_encode($authUser . ':' . $authPw)];
        }
        if ($authorizationHeader) {
            $options[CURLOPT_HTTPHEADER] = ["Authorization: " . $authorizationHeader];
        }
        $this->curlOptions = $options;
    }

    public function getAction($path0, $path1 = null, $path2 = null, $path3 = null, $path4 = null)
    {
        $this->curlOptions[CURLOPT_CUSTOMREQUEST] = "GET";

        $suffix = '/'.$path0;
        if($path1!=null) $suffix.='/'.$path1;
        if($path2!=null) $suffix.='/'.$path2;
        if($path3!=null) $suffix.='/'.$path3;
        if($path4!=null) $suffix.='/'.$path4;
        $this->curlOptions[CURLOPT_URL] = $this->config->api->apiUrl.trim($suffix);
        curl_setopt_array($this->curl, $this->curlOptions);
        $response = curl_exec($this->curl);
        $response = $this->handleHeaders($response);
        curl_close($this->curl);
        return $response;
    }

    public function handleHeaders($response)
    {
        $response = explode("\r\n\r\n", $response);
        while (strstr($response[0], "HTTP/1.1 100 Continue")) {
            array_shift($response);
        }
        list ($headerString, $body) = $response;
        $this->response->setContentType(curl_getinfo($this->curl, CURLINFO_CONTENT_TYPE));
        $this->response->setStatusCode(curl_getinfo($this->curl, CURLINFO_HTTP_CODE));
        foreach (explode("\r\n", $headerString) as $header) {
            $arr = explode(":", $header);
            if(count($arr)<2) continue;
            list ($k, $v) = $arr;
            if (strstr($k, 'Disposition')) {
                $this->response->setHeader(trim($k), trim($v));
            }
        }
        return $body;
    }

    public function postAction($path0, $path1 = null, $path2 = null, $path3 = null, $path4 = null)
    {
        $this->curlOptions[CURLOPT_CUSTOMREQUEST] = "POST";
        if ($this->request->getHeader("Content-Type") == "application/x-www-form-urlencoded") {
            $this->curlOptions[CURLOPT_HTTPHEADER][] = "Content-Type: application/x-www-form-urlencoded";
        }

        // $this->curlOptions[CURLOPT_URL] = $this->config->api->apiUrl
        //     . DIRECTORY_SEPARATOR
        //     . trim(
        //         implode(DIRECTORY_SEPARATOR, [$path0, $path1, $path2, $path3, $path4]),
        //         ' /'
        //     );

        $suffix = '/'.$path0;
        if($path1!=null) $suffix.='/'.$path1;
        if($path2!=null) $suffix.='/'.$path2;
        if($path3!=null) $suffix.='/'.$path3;
        if($path4!=null) $suffix.='/'.$path4;
        $this->curlOptions[CURLOPT_URL] = $this->config->api->apiUrl.trim($suffix);

        $this->curlOptions[CURLOPT_POSTFIELDS] = urldecode(http_build_query($this->request->getPost()));
        if ($this->request->hasFiles()) {
            /** @var \Phalcon\Http\Request\FileInterface $file */
            $file = array_shift($this->request->getUploadedFiles(true));
            $this->curlOptions[CURLOPT_POSTFIELDS] = [
                'imageFile' => new CURLFile(
                    $file->getTempName(), $file->getRealType(), $file->getName()
                ),
            ];
        }

        curl_setopt_array($this->curl, $this->curlOptions);
        $response = curl_exec($this->curl);
        $response = $this->handleHeaders($response);
        curl_close($this->curl);
        return $response;
    }

    public function putAction($path0, $path1 = null, $path2 = null, $path3 = null, $path4 = null)
    {
        $this->curlOptions[CURLOPT_CUSTOMREQUEST] = "PUT";
        if ($this->request->getHeader("Content-Type") == "application/x-www-form-urlencoded") {
            $this->curlOptions[CURLOPT_HTTPHEADER][] = "Content-Type: application/x-www-form-urlencoded";
        }
        // $this->curlOptions[CURLOPT_URL] = $this->config->api->apiUrl
        //     . DIRECTORY_SEPARATOR
        //     . trim(
        //         implode(DIRECTORY_SEPARATOR, [$path0, $path1, $path2, $path3, $path4]),
        //         ' /'
        //     );
        $suffix = '/'.$path0;
        if($path1!=null) $suffix.='/'.$path1;
        if($path2!=null) $suffix.='/'.$path2;
        if($path3!=null) $suffix.='/'.$path3;
        if($path4!=null) $suffix.='/'.$path4;
        $this->curlOptions[CURLOPT_URL] = $this->config->api->apiUrl.trim($suffix);

        $this->curlOptions[CURLOPT_POSTFIELDS] = urldecode(http_build_query($this->request->getPut()));

        curl_setopt_array($this->curl, $this->curlOptions);
        $response = curl_exec($this->curl);
        $response = $this->handleHeaders($response);
        curl_close($this->curl);
        return $response;
    }
}
