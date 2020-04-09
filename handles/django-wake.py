from rest_framework.response import Response
from rest_framework.views import APIView
from rest_framework import status
from django.http import HttpResponse

class Wake(APIView):
    def post(self, request):
        if not "identifier" in request.data:
            return Response(status=status.HTTP_400_BAD_REQUEST)
        return HttpResponse(request.data['identifier'])
