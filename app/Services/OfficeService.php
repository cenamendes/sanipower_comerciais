<?php

namespace App\Services;

class OfficeService
{
    public function criarEventoOutlook()
    {
        $accessToken = "eyJ0eXAiOiJKV1QiLCJub25jZSI6ImZ3eGJOV0p2N2pXYXBCaDNfeGh3WFBablc0X2ZOcFFYdnhoamlrd3NESmMiLCJhbGciOiJSUzI1NiIsIng1dCI6IkwxS2ZLRklfam5YYndXYzIyeFp4dzFzVUhIMCIsImtpZCI6IkwxS2ZLRklfam5YYndXYzIyeFp4dzFzVUhIMCJ9.eyJhdWQiOiIwMDAwMDAwMy0wMDAwLTAwMDAtYzAwMC0wMDAwMDAwMDAwMDAiLCJpc3MiOiJodHRwczovL3N0cy53aW5kb3dzLm5ldC8wYWIyMjcwOC1lZDlmLTRiZDQtYTdmYy02N2JjZDE2MTIyYzgvIiwiaWF0IjoxNzE4MjcwOTkxLCJuYmYiOjE3MTgyNzA5OTEsImV4cCI6MTcxODM1NzY5MSwiYWNjdCI6MCwiYWNyIjoiMSIsImFpbyI6IkFUUUF5LzhYQUFBQUp4UjdLY2ZMOVJXZTNmK1RDK3hpYWNMOEljUU9YMFhoak9xRTZmZ3dVK2dvd1pDc29ublhYbnlmR1FWVEtrRHQiLCJhbXIiOlsicHdkIl0sImFwcF9kaXNwbGF5bmFtZSI6IkdyYXBoIEV4cGxvcmVyIiwiYXBwaWQiOiJkZThiYzhiNS1kOWY5LTQ4YjEtYThhZC1iNzQ4ZGE3MjUwNjQiLCJhcHBpZGFjciI6IjAiLCJmYW1pbHlfbmFtZSI6Ik1lbmRlcyIsImdpdmVuX25hbWUiOiJKb8OjbyIsImlkdHlwIjoidXNlciIsImlwYWRkciI6Ijg5LjExNC4yMDIuMTU0IiwibmFtZSI6Ikpvw6NvIE1lbmRlcyIsIm9pZCI6IjY2M2YzOWYxLTlhNWUtNDVmMC1iOGFhLWExNTk3ODM3MTY5YSIsInBsYXRmIjoiMyIsInB1aWQiOiIxMDAzMjAwMzVCMzI4RkY3IiwicmgiOiIwLkFhNEFDQ2V5Q3BfdDFFdW5fR2U4MFdFaXlBTUFBQUFBQUFBQXdBQUFBQUFBQUFDckFKQS4iLCJzY3AiOiJDYWxlbmRhcnMuUmVhZCBDYWxlbmRhcnMuUmVhZEJhc2ljIENhbGVuZGFycy5SZWFkV3JpdGUgb3BlbmlkIFBlb3BsZS5SZWFkIHByb2ZpbGUgVXNlci5SZWFkIFVzZXIuUmVhZEJhc2ljLkFsbCBlbWFpbCIsInN1YiI6ImJLNWZzY3RTMmNHOWN0aFJvb2trNXVTVk13SFhIenNjN19JY0Z6N1pBeVEiLCJ0ZW5hbnRfcmVnaW9uX3Njb3BlIjoiRVUiLCJ0aWQiOiIwYWIyMjcwOC1lZDlmLTRiZDQtYTdmYy02N2JjZDE2MTIyYzgiLCJ1bmlxdWVfbmFtZSI6ImpvYW8ubWVuZGVzQGRldi5icnZyLnB0IiwidXBuIjoiam9hby5tZW5kZXNAZGV2LmJydnIucHQiLCJ1dGkiOiJ6OXVHQ29ocC1FT21DdFJZUDFZLUFBIiwidmVyIjoiMS4wIiwid2lkcyI6WyJiNzlmYmY0ZC0zZWY5LTQ2ODktODE0My03NmIxOTRlODU1MDkiXSwieG1zX2NjIjpbIkNQMSJdLCJ4bXNfaWRyZWwiOiIxIDEyIiwieG1zX3NzbSI6IjEiLCJ4bXNfc3QiOnsic3ViIjoiczVJd08tMU40ZVZLdG1qRWNleHdtUzc4UHNnNzBVSWV5cFhNalpYMFV1cyJ9LCJ4bXNfdGNkdCI6MTcwMDY3ODU2MSwieG1zX3RkYnIiOiJFVSJ9.EZZhTQ2GlyCPXkq3Tdxs51otflbyGeowZjuNPhmaC_oWYlBdIOI1UXJzDPeXnRFJAOQJZwfLK1FYwUmuah_IPh4NCwjc1NA1SRItOZx7P3OssB-LcQMbyO6Tt0wkPA8AcG0HecDKLQUR0ezl_8NoOB6U2XGaJQ1dOPsZHwspokUBz1JWS_ZGR9KKPMdhmOKDyXrc80v2TT-XTL23Xv2OiAwqKd947oqRsmGciPw0Fg3FaJKpK6dJ7j9j3KDpSWtfR2OLEpNOKH_BETamyT-hVqZdVC_wzO4rGC-2jMZFJWAl3XAhIqUlgUAzhD7AmfRVOmSLzNvhwLU5kgPqPHPYRg";
        
        $curl = curl_init();

        $data = json_encode([
            "subject" => "Meeting with team",
            "body" => [
                "contentType" => "HTML",
                "content" => "Discuss project status and next steps."
            ],
            "start" => [
                "dateTime" => "2024-06-14T10:00:00",
                "timeZone" => "Pacific Standard Time"
            ],
            "end" => [
                "dateTime" => "2024-06-14T11:00:00",
                "timeZone" => "Pacific Standard Time"
            ],
            "location" => [
                "displayName" => "Conference Room"
            ],
            "attendees" => [
                [
                    "emailAddress" => [
                        "address" => "attendee@example.com",
                        "name" => "Attendee Name"
                    ],
                    "type" => "required"
                ]
            ]
        ]);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.microsoft.com/v1.0/me/calendarview?startdatetime=2024-03-15T11:40:14.168Z&enddatetime=2024-03-22T11:40:14.168Z',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJub25jZSI6ImZ3eGJOV0p2N2pXYXBCaDNfeGh3WFBablc0X2ZOcFFYdnhoamlrd3NESmMiLCJhbGciOiJSUzI1NiIsIng1dCI6IkwxS2ZLRklfam5YYndXYzIyeFp4dzFzVUhIMCIsImtpZCI6IkwxS2ZLRklfam5YYndXYzIyeFp4dzFzVUhIMCJ9.eyJhdWQiOiIwMDAwMDAwMy0wMDAwLTAwMDAtYzAwMC0wMDAwMDAwMDAwMDAiLCJpc3MiOiJodHRwczovL3N0cy53aW5kb3dzLm5ldC8wYWIyMjcwOC1lZDlmLTRiZDQtYTdmYy02N2JjZDE2MTIyYzgvIiwiaWF0IjoxNzE4MjcwOTkxLCJuYmYiOjE3MTgyNzA5OTEsImV4cCI6MTcxODM1NzY5MSwiYWNjdCI6MCwiYWNyIjoiMSIsImFpbyI6IkFUUUF5LzhYQUFBQUp4UjdLY2ZMOVJXZTNmK1RDK3hpYWNMOEljUU9YMFhoak9xRTZmZ3dVK2dvd1pDc29ublhYbnlmR1FWVEtrRHQiLCJhbXIiOlsicHdkIl0sImFwcF9kaXNwbGF5bmFtZSI6IkdyYXBoIEV4cGxvcmVyIiwiYXBwaWQiOiJkZThiYzhiNS1kOWY5LTQ4YjEtYThhZC1iNzQ4ZGE3MjUwNjQiLCJhcHBpZGFjciI6IjAiLCJmYW1pbHlfbmFtZSI6Ik1lbmRlcyIsImdpdmVuX25hbWUiOiJKb8OjbyIsImlkdHlwIjoidXNlciIsImlwYWRkciI6Ijg5LjExNC4yMDIuMTU0IiwibmFtZSI6Ikpvw6NvIE1lbmRlcyIsIm9pZCI6IjY2M2YzOWYxLTlhNWUtNDVmMC1iOGFhLWExNTk3ODM3MTY5YSIsInBsYXRmIjoiMyIsInB1aWQiOiIxMDAzMjAwMzVCMzI4RkY3IiwicmgiOiIwLkFhNEFDQ2V5Q3BfdDFFdW5fR2U4MFdFaXlBTUFBQUFBQUFBQXdBQUFBQUFBQUFDckFKQS4iLCJzY3AiOiJDYWxlbmRhcnMuUmVhZCBDYWxlbmRhcnMuUmVhZEJhc2ljIENhbGVuZGFycy5SZWFkV3JpdGUgb3BlbmlkIFBlb3BsZS5SZWFkIHByb2ZpbGUgVXNlci5SZWFkIFVzZXIuUmVhZEJhc2ljLkFsbCBlbWFpbCIsInN1YiI6ImJLNWZzY3RTMmNHOWN0aFJvb2trNXVTVk13SFhIenNjN19JY0Z6N1pBeVEiLCJ0ZW5hbnRfcmVnaW9uX3Njb3BlIjoiRVUiLCJ0aWQiOiIwYWIyMjcwOC1lZDlmLTRiZDQtYTdmYy02N2JjZDE2MTIyYzgiLCJ1bmlxdWVfbmFtZSI6ImpvYW8ubWVuZGVzQGRldi5icnZyLnB0IiwidXBuIjoiam9hby5tZW5kZXNAZGV2LmJydnIucHQiLCJ1dGkiOiJ6OXVHQ29ocC1FT21DdFJZUDFZLUFBIiwidmVyIjoiMS4wIiwid2lkcyI6WyJiNzlmYmY0ZC0zZWY5LTQ2ODktODE0My03NmIxOTRlODU1MDkiXSwieG1zX2NjIjpbIkNQMSJdLCJ4bXNfaWRyZWwiOiIxIDEyIiwieG1zX3NzbSI6IjEiLCJ4bXNfc3QiOnsic3ViIjoiczVJd08tMU40ZVZLdG1qRWNleHdtUzc4UHNnNzBVSWV5cFhNalpYMFV1cyJ9LCJ4bXNfdGNkdCI6MTcwMDY3ODU2MSwieG1zX3RkYnIiOiJFVSJ9.EZZhTQ2GlyCPXkq3Tdxs51otflbyGeowZjuNPhmaC_oWYlBdIOI1UXJzDPeXnRFJAOQJZwfLK1FYwUmuah_IPh4NCwjc1NA1SRItOZx7P3OssB-LcQMbyO6Tt0wkPA8AcG0HecDKLQUR0ezl_8NoOB6U2XGaJQ1dOPsZHwspokUBz1JWS_ZGR9KKPMdhmOKDyXrc80v2TT-XTL23Xv2OiAwqKd947oqRsmGciPw0Fg3FaJKpK6dJ7j9j3KDpSWtfR2OLEpNOKH_BETamyT-hVqZdVC_wzO4rGC-2jMZFJWAl3XAhIqUlgUAzhD7AmfRVOmSLzNvhwLU5kgPqPHPYRg',
            ),
        ));

        $response = curl_exec($curl);


        curl_close($curl);

        $response_decoded = json_decode($response);


        return $response_decoded;
    }

    public function getToken()
    {

    }
}